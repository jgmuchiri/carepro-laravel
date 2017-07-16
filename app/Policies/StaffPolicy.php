<?php

namespace App\Policies;

use App\Models\Staff;
use App\Models\Permissions\Permission;
use App\Models\Permissions\Role;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class StaffPolicy
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
     * Checks if a user is authorized to create a staff member
     *
     * @param User $user
     *
     * @return bool
     */
    public function create(User $user)
    {
        return $user->role->permissions->contains('name', Permission::MANAGE_STAFF_MEMBERS);
    }

    /**
     * Checks if a user is authorized to edit a staff member
     *
     * @param User $user
     *
     * @return bool
     */
    public function edit(User $user)
    {
        return $user->role->permissions->contains('name', Permission::MANAGE_STAFF_MEMBERS);
    }

    /**
     * Checks if a user is authorized to delete a specific staff member
     *
     * @param User $user
     * @param Staff $staff
     *
     * @return bool
     */
    public function delete(User $user, Staff $staff)
    {
        if (!$staff->is_active) {
            return false;
        }

        return $user->role->permissions->contains('name', Permission::MANAGE_STAFF_MEMBERS) &&
            $staff->user->daycare_id === $user->daycare_id;
    }

    /**
     * Checks if a user is authorized to update a specific staff member
     *
     * @param User $user
     * @param Staff $staff
     *
     * @return bool
     */
    public function update(User $user, Staff $staff)
    {
        if (!$staff->is_active) {
            return false;
        }

        return $user->role->permissions->contains('name', Permission::MANAGE_STAFF_MEMBERS) &&
            $staff->user->daycare_id === $user->daycare_id;
    }

    /**
     * Checks if a user is authorized to store a staff member
     *
     * @param User $user
     *
     * @return bool
     */
    public function store(User $user)
    {
        return $user->role->permissions->contains('name', Permission::MANAGE_STAFF_MEMBERS);
    }
}
