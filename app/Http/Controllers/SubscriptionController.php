<?php

namespace App\Http\Controllers;

use App\Models\Child;
use App\Models\Staff;
use App\Models\Subscriptions\Plan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;

/**
 * Class SubscriptionController
 *
 * Handles user subscriptions
 *
 * @package App\Http\Controllers
 */
class SubscriptionController extends Controller
{
    /**
     * Shows the plans page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showPlans()
    {
        $plans = Plan::all();
        return view('plans')->with(compact('plans'));
    }

    /**
     * Shows the billing page
     *
     * @param Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showBilling(Request $request)
    {
        return view('account.billing')->with(['user' => $request->user()]);
    }

    /**
     * Subscribes to a plan
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function subscribe(Request $request)
    {
        $user = $request->user();

        if ($user->subscribed('main') && !$user->subscription('main')->onTrial()) {
            redirect()->route('home')->withErrors([__('You are already subscribed.')]);
        }

        $trial_days = Carbon::today()->diffInDays($user->trial_ends_at, false);

        $subscription = $user->newSubscription('main', $user->trialPlan->name);

        if ($trial_days > 0) {
            $subscription->trialDays($trial_days);
        }

        $subscription->create(
            $request->input('stripeToken'),
            [
                'email' => $user->email,
            ]
        );

        return redirect()->route('home')
            ->with(['successes' => new MessageBag([__('Successfully subscribed.')])]);
    }

    /**
     * Subscribes a user to the trial
     *
     * @param Request $request
     * @param string $plan_name
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function subscribeToTrial(Request $request, $plan_name)
    {
        $plan = Plan::whereName($plan_name)->first();

        if (empty($plan)) {
            return redirect()->route('plans')->withErrors(__('Invalid plan selected. Please try again.'));
        }

        $user = $request->user();
        $user->trial_ends_at = Carbon::now()->addDays(14);
        $user->trialPlan()->associate($plan);
        $user->save();

        return redirect()->route('daycare.create');
    }

    /**
     * Cancels a subscription
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function cancel(Request $request)
    {
        $request->user()->subscription('main')->cancel();

        return redirect()->route('account.profile')
            ->with(['successes' => new MessageBag([__('Successfully canceled subscription')])]);
    }

    /**
     * Resumes a subscription
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function resume(Request $request)
    {
        $request->user()->subscription('main')->resume();

        return redirect()->route('account.profile')
            ->with(['successes' => new MessageBag([__('Successfully resumed subscription')])]);
    }

    /**
     * Updates the credit card for a subscription
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateCreditCard(Request $request)
    {
        $request->user()->updateCard($request->input('stripeToken'));

        return redirect()->back()
            ->with(['successes' => new MessageBag([__('Successfully updated credit card.')])]);
    }

    /**
     * Updates a user subscription
     *
     * @param Request $request
     * @param string $plan_name
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateSubscription(Request $request, $plan_name)
    {
        $plan = Plan::whereName($plan_name)->first();

        if (empty($plan)) {
            return redirect()->route('account.profile')
                ->withErrors(__('Invalid plan selected. Please try again.'));
        }

        $user = $request->user();
        $user->subscription('main')->swap($plan_name);
        $user->save();

        $staff = Staff::whereDaycareId($user->daycare_id)->get();
        $children = Child::whereDaycareId($user->daycare_id)->get();

        if ($plan->number_of_staff_allowed < $staff->count()) {
            for ($i = 0; $i < $staff->count(); $i++) {
                if ($i > $plan->number_of_staff_allowed) {
                    break;
                }

                $staff[$i]->is_active = false;
                $staff[$i]->save();
            }
        } else {
            foreach ($staff as $staff_member) {
                if (!$staff_member->is_active) {
                    $staff_member->is_active = true;
                    $staff_member->save();
                }
            }
        }

        if ($plan->number_of_children_allowed < $children->count()) {
            for ($i = 0; $i < $children->count(); $i++) {
                if ($i > $plan->number_of_children_allowed) {
                    continue;
                }

                $children[$i]->is_active = false;
                $children[$i]->save();
            }
        } else {
            foreach ($children as $child) {
                if (!$child->is_active) {
                    $child->is_active = true;
                    $child->save();
                }
            }
        }

        return redirect()->route('account.profile')
            ->with(['successes' => new MessageBag([_('Successfully updated plan.')])]);
    }
}
