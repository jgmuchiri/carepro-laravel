<?php

namespace App\Policies;

use App\Models\ChildParent;
use App\Models\Permissions\Permission;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ParentPolicy
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
     * Checks if a user is authorized to create a parent
     *
     * @param User $user
     *
     * @return bool
     */
    public function create(User $user)
    {
        return $user->role->permissions->contains('name', Permission::MANAGE_PARENTS);
    }

    /**
     * Checks if a user is authorized to edit a parent
     *
     * @param User $user
     *
     * @return bool
     */
    public function edit(User $user)
    {
        return $user->role->permissions->contains('name', Permission::MANAGE_PARENTS);
    }

    /**
     * Checks if a user is authorized to delete a specific parent
     *
     * @param User $user
     * @param ChildParent $parent
     *
     * @return bool
     */
    public function delete(User $user, ChildParent $parent)
    {
        return $user->role->permissions->contains('name', Permission::MANAGE_PARENTS) &&
            $parent->user->daycare_id === $user->daycare_id;
    }

    /**
     * Checks if a user is authorized to update a specific parent
     *
     * @param User $user
     * @param ChildParent $parent
     *
     * @return bool
     */
    public function update(User $user, ChildParent $parent)
    {
        return $user->role->permissions->contains('name', Permission::MANAGE_PARENTS) &&
            $parent->user->daycare_id === $user->daycare_id;
    }

    /**
     * Checks if a user is authorized to store a parent
     *
     * @param User $user
     *
     * @return bool
     */
    public function store(User $user)
    {
        return $user->role->permissions->contains('name', Permission::MANAGE_PARENTS);
    }

    /**
     *
     * Returns if a user is authorized to show a parent
     *
     * @param User $user
     * @param ChildParent $parent
     *
     * @return bool
     */
    public function show(User $user, ChildParent $parent)
    {
        return $user->role->permissions->contains('name', Permission::MANAGE_PARENTS);
    }
}
