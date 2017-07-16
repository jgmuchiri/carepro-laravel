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

        $owner = $request->user()->daycare->owner;
        if (
            (empty($owner->trial_ends_at) || $owner->trial_ends_at->lt(Carbon::now())) &&
            !$owner->subscribed('main') &&
            !$owner->onGenericTrial()
        ) {
            return redirect()->route('home')
                ->withErrors([
                    __('Daycare is currently not subscribed. Ask the daycare owner to check their subscription status.')
                ]);
        }

        return $next($request);
    }
}
