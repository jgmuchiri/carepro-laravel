<?php

namespace App\Http\Controllers;

use App\Models\Subscriptions\Plan;
use Carbon\Carbon;
use Illuminate\Http\Request;

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

    public function subscribe(Request $request)
    {

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
}
