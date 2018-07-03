<?php

namespace App\Http\Middleware;

use App\Models\Permissions\Role;
use Carbon\Carbon;
use Closure;

class DaycareHasActiveSubscription
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->user()->role->name == Role::ADMIN_ROLE) {
            return $next($request);
        }

        $daycare = $request->user()->daycare;
        $due_date = Carbon::parse($daycare->trial_ends_at);
        if (
            (empty($daycare->trial_ends_at) || $due_date->lt(Carbon::now()->toDateTimeString())) &&
            !$daycare->subscribed('main') &&
            !$daycare->onGenericTrial()
        ) {
            return redirect('/home')
                ->withErrors([
                    __('Daycare is currently not subscribed. Ask the daycare owner to check their subscription status.')
                ]);
        }

        return $next($request);
    }
}
