<?php

namespace App\Http\Controllers;

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
        return view('plans');
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

        return redirect()->route('home')->with(['successes' => new MessageBag(['Successfully subscribed.'])]);
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
            return redirect()->route('plans')->withErrors('Invalid plan selected. Please try again.');
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
            ->with(['successes' => new MessageBag(['Successfully canceled subscription'])]);
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
            ->with(['successes' => new MessageBag(['Successfully resumed subscription'])]);
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
            ->with(['successes' => new MessageBag(['Successfully updated credit card.'])]);
    }
}
