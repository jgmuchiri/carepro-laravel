<?php

namespace App\Http\Controllers;

use App\Models\Addresses\Address;
use App\Models\Permissions\Role;
use App\Models\Subscriptions\Plan;
use App\Services\MailService;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;

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
        if(count($user->trialPlan) && $user->trial_ends_at->gte(Carbon::now())) {
            $current_plan_name = $user->trialPlan->name;
        }
        if($subscription != null) {
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

    /**
     * @param Request $request
     * @return $this
     */
    function updateProfile(Request $request)
    {
        $id = $request->user_id;
        $rules = [
            'name' => 'required|max:50',
            'email' => 'required|email'
        ];
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;

        $data = $request->toArray();
        $address = new Address();
        $address->updateFromRawInput($data);

        if($request->has('password')) {
            if($request->password !== $request->password_confirmation) {
                return redirect()->back()->withInput()->with(['errors' => __('Password does not match')]);
            }
            $user->password = bcrypt($request->password);
        }
        $user->save();

        $user->save();

        MailService::notifyUserAccountChange($user);

        return redirect()->back()
            ->with(['successes' => new MessageBag([__('Account has been updated')])]);
    }
}
