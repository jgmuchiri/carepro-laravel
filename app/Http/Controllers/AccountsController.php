<?php

namespace App\Http\Controllers;

use App\Models\Subscriptions\Plan;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AccountsController extends Controller
{
    /**
     * Shows the account profile page
     *
     * @param Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showProfile(Request $request)
    {
        $user = $request->user()->load(['address', 'subscriptions', 'trialPlan']);
        $subscription = $user->subscription('main');
        $plans = Plan::all();

        $current_plan_name = null;
        if (count($user->trialPlan) && $user->trial_ends_at->gte(Carbon::now())) {
            $current_plan_name = $user->trialPlan->name;
        }
        if ($subscription != null) {
            $stripe_subscription = $subscription->asStripeSubscription();
            $current_plan_name = $subscription->stripe_plan;
        }

        $today = Carbon::today();

        return view('account.profile')
            ->with(compact(
                'user',
                'stripe_subscription',
                'today',
                'plans',
                'subscription',
                'current_plan_name'
            ));
    }
}
