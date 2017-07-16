<?php

namespace App\Policies;

use App\Models\Child;
use App\Models\Permissions\Permission;
use App\Models\Permissions\Role;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ChildPolicy
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
     * Checks if a user is authorized to create a child
     *
     * @param User $user
     *
     * @return bool
     */
    public function create(User $user)
    {
        if ($user->role->name == Role::TENANT_ROLE) {
            return true;
        }

        return $user->role->permissions->contains('name', Permission::MANAGE_CHILDREN) ||
            $user->role->permissions->contains('name', Permission::VIEW_OWN_CHILDREN);
    }

    /**
     * Checks if a user is authorized to edit a child
     *
     * @param User $user
     *
     * @return bool
     */
    public function edit(User $user)
    {
        if ($user->role->name == Role::TENANT_ROLE) {
            return true;
        }

        return $user->role->permissions->contains('name', Permission::MANAGE_CHILDREN) ||
            $user->role->permissions->contains('name', Permission::VIEW_OWN_CHILDREN ||
            $user->role->permissions->contains('name', Permission::MANAGE_ASSIGNED_CHILDREN));
    }

    /**
     * Checks if a user is authorized to delete a specific child
     *
     * @param User $user
     * @param Child $child
     *
     * @return bool
     */
    public function delete(User $user, Child $child)
    {
        if (!$child->is_active) {
            return false;
        }

        if ($user->role->name == Role::TENANT_ROLE &&
            $child->parents->first()->user->daycare_id === $user->daycare_id) {
            return true;
        }

        return $user->role->permissions->contains('name', Permission::MANAGE_CHILDREN) &&
            $child->parents->first()->user->daycare_id === $user->daycare_id;
    }

    /**
     * Checks if a user is authorized to update a specific child
     *
     * @param User $user
     * @param Child $child
     *
     * @return bool
     */
    public function update(User $user, Child $child)
    {
        if (!$child->is_active) {
            return false;
        }

        if ($user->role->name == Role::TENANT_ROLE &&
            $child->parents->first()->user->daycare_id === $user->daycare_id) {
            return true;
        }

        if (
            (
                $user->role->permissions->contains('name', Permission::MANAGE_CHILDREN) &&
                $child->parents->first()->user->daycare_id === $user->daycare_id
            ) ||
            (
                $user->role->permissions->contains('name', Permission::VIEW_OWN_CHILDREN) &&
                $child->parents->contains('user.id', $user->id)
            )
        ) {
            return true;
        }

        if (
            $user->role->permissions->contains('name', Permission::MANAGE_ASSIGNED_CHILDREN) &&
            $child->parents->first()->user->daycare_id === $user->daycare_id
        ) {
            foreach ($child->groups as $group) {
                foreach ($group->staff as $staff_member) {
                    if ($staff_member->user_id = $user->id) {
                        return true;
                    }
                }
            }
        }

        return false;
    }

    /**
     * Checks if a user is authorized to update a specific child's status
     *
     * @param User $user
     * @param Child $child
     *
     * @return bool
     */
    public function updateStatus(User $user, Child $child)
    {
        if (!$child->is_active) {
            return false;
        }

        if ($user->role->name == Role::TENANT_ROLE &&
            $child->parents->first()->user->daycare_id === $user->daycare_id) {
            return true;
        }

        if ($user->role->permissions->contains('name', Permission::MANAGE_CHILDREN) &&
            $child->parents->first()->user->daycare_id === $user->daycare_id) {
            return true;
        }

        if (
            $user->role->permissions->contains('name', Permission::MANAGE_ASSIGNED_CHILDREN) &&
            $child->parents->first()->user->daycare_id === $user->daycare_id
        ) {
            foreach ($child->groups as $group) {
                foreach ($group->staff as $staff_member) {
                    if ($staff_member->user_id = $user->id) {
                        return true;
                    }
                }
            }
        }

        return false;
    }

    /**
     * Checks if a user is authorized to store a child
     *
     * @param User $user
     *
     * @return bool
     */
    public function store(User $user)
    {
        if ($user->role->name == Role::TENANT_ROLE) {
            return true;
        }

        return $user->role->permissions->contains('name', Permission::MANAGE_CHILDREN) ||
            $user->role->permissions->contains('name', Permission::VIEW_OWN_CHILDREN);
    }

    /**
     * Checks if a user can view a child
     *
     * @param User $user
     * @param Child $child
     *
     * @return bool
     */
    public function show(User $user, Child $child)
    {
        if ($user->role->name == Role::TENANT_ROLE &&
            $child->parents->first()->user->daycare_id === $user->daycare_id) {
            return true;
        }

        if (
            (
                $user->role->permissions->contains('name', Permission::MANAGE_CHILDREN) &&
                $child->parents->first()->user->daycare_id === $user->daycare_id
            ) ||
            (
                $user->role->permissions->contains('name', Permission::VIEW_OWN_CHILDREN) &&
                $child->parents->contains('user.id', $user->id)
            )
        ) {
            return true;
        }

        if (
            $user->role->permissions->contains('name', Permission::MANAGE_ASSIGNED_CHILDREN) &&
            $child->parents->first()->user->daycare_id === $user->daycare_id
        ) {
            foreach ($child->groups as $group) {
                foreach ($group->staff as $staff_member) {
                    if ($staff_member->user_id = $user->id) {
                        return true;
                    }
                }
            }
        }

        return false;
    }

    /**
     * Checks if a user can view a child
     *
     * @param User $user
     * @param Child $child
     *
     * @return bool
     */
    public function showGeneric(User $user)
    {
        if ($user->role->name == Role::TENANT_ROLE) {
            return true;
        }

        return $user->role->permissions->contains('name', Permission::MANAGE_CHILDREN) ||
            $user->role->permissions->contains('name', Permission::VIEW_OWN_CHILDREN ||
            $user->role->permissions->contains('name', Permission::MANAGE_ASSIGNED_CHILDREN));
    }
}
