<?php

namespace App\Providers;

use App\Models\Child;
use App\Models\ChildParent;
use App\Models\Groups\Group;
use App\Models\Permissions\Role;
use App\Models\Subscriptions\Plan;
use App\Models\Staff;
use App\Policies\ChildPolicy;
use App\Policies\GroupPolicy;
use App\Policies\ParentPolicy;
use App\Policies\RolesPolicy;
use App\Policies\SettingsPolicy;
use App\Policies\StaffPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Plan::class => SettingsPolicy::class,
        Role::class => RolesPolicy::class,
        Staff::class => StaffPolicy::class,
        ChildParent::class => ParentPolicy::class,
        Child::class => ChildPolicy::class,
        Group::class => GroupPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Passport::routes();
    }
}
