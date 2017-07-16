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
        $user = $request->user()->load(['address', 'subscriptions']);
        $subscription = $user->subscription('main');
        $plans = Plan::all();

        if ($subscription != null) {
            $stripe_subscription = $subscription->asStripeSubscription();
        }

        $today = Carbon::today();

        return view('account.profile')
            ->with(compact('user', 'stripe_subscription', 'today', 'plans', 'subscription'));
    }
}
