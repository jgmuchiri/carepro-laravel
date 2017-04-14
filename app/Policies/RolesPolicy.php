<?php

namespace App\Policies;

use App\Models\Permissions\Permission;
use App\Models\Permissions\Role;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolesPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Checks if a user is authorized to create a role
     *
     * @param User $user
     *
     * @return bool
     */
    public function create(User $user)
    {
        return $user->role->name === Role::TENANT_ROLE;
    }

    /**
     * Checks if a user is authorized to edit a role
     *
     * @param User $user
     *
     * @return bool
     */
    public function edit(User $user)
    {
        return $user->role->name === Role::TENANT_ROLE;
    }

    /**
     * Checks if a user is authorized to delete a specific role
     *
     * @param User $user
     * @param Role $role
     *
     * @return bool
     */
    public function delete(User $user, Role $role)
    {
        return $user->role->name === Role::TENANT_ROLE && $role->daycare_id === $user->daycare_id;
    }

    /**
     * Checks if a user is authorized to update a specific role
     *
     * @param User $user
     * @param Role $role
     *
     * @return bool
     */
    public function update(User $user, Role $role)
    {
        return $user->role->name === Role::TENANT_ROLE && $role->daycare_id === $user->daycare_id;
    }

    /**
     * Checks if a user is authorized to store a specific role
     *
     * @param User $user
     * @param Role $role
     *
     * @return bool
     */
    public function store(User $user)
    {
        return $user->role->name === Role::TENANT_ROLE;
    }
}
