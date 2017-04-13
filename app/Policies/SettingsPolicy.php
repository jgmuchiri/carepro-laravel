<?php

namespace App\Policies;

use App\Models\Permissions\Permission;
use App\Models\Subscriptions\Plan;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SettingsPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Determine if settings can be updated by the user.
     *
     * @param  \App\User  $user
     *
     * @return bool
     */
    public function update(User $user)
    {
        return $user->role->permissions->contains('name', Permission::MANAGE_APPLICATION_SETTINGS);
    }
}
