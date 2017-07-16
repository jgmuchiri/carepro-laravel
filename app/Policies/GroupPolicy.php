<?php

namespace App\Policies;

use App\Models\Groups\Group;
use App\Models\Permissions\Permission;
use App\Models\Permissions\Role;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class GroupPolicy
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
     * Checks if a user is authorized to create a group
     *
     * @param User $user
     *
     * @return bool
     */
    public function create(User $user)
    {
        return $user->role->permissions->contains('name', Permission::MANAGE_CHILDREN);
    }

    /**
     * Checks if a user is authorized to edit a group
     *
     * @param User $user
     *
     * @return bool
     */
    public function edit(User $user)
    {
        return $user->role->permissions->contains('name', Permission::MANAGE_CHILDREN);
    }

    /**
     * Checks if a user is authorized to delete a specific group
     *
     * @param User $user
     * @param Group $group
     *
     * @return bool
     */
    public function delete(User $user, Group $group)
    {
        return $user->role->permissions->contains('name', Permission::MANAGE_CHILDREN) &&
            $group->daycare_id === $user->daycare_id;
    }

    /**
     * Checks if a user is authorized to update a specific group
     *
     * @param User $user
     * @param Group $group
     *
     * @return bool
     */
    public function update(User $user, Group $group)
    {
        return $user->role->permissions->contains('name', Permission::MANAGE_CHILDREN) &&
            $group->daycare_id === $user->daycare_id;
    }

    /**
     * Checks if a user is authorized to store a group
     *
     * @param User $user
     *
     * @return bool
     */
    public function store(User $user)
    {
        return $user->role->permissions->contains('name', Permission::MANAGE_CHILDREN);
    }

    public function showGeneric(User $user)
    {
        return $user->role->permissions->contains('name', Permission::MANAGE_CHILDREN);
    }

    public function show(User $user)
    {
        return $user->role->permissions->contains('name', Permission::MANAGE_CHILDREN);
    }
}
