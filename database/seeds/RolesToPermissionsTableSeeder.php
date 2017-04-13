<?php

use App\Models\Permissions\Role;
use App\Models\Permissions\Permission;
use Illuminate\Database\Seeder;

class RolesToPermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            Role::ADMIN_ROLE => [
                Permission::VIEW_TENANT,
                Permission::REGISTER_TENANT,
                Permission::EDIT_TENANT,
                Permission::SEND_PASSWORD_RESET_EMAILS,
                Permission::SEND_MESSAGES_TO_TENANTS,
                Permission::MANAGE_SUBSCRIPTIONS,
                Permission::MANAGE_APPLICATION_SETTINGS
            ],
            Role::TENANT_ROLE => [
                Permission::MANAGE_STAFF_MEMBERS,
                Permission::MANAGE_CHILDREN,
                Permission::MANAGE_PARENTS,
                Permission::GENERATE_REPORTS,
            ],
            Role::STAFF_ROLE => [
                Permission::MANAGE_ASSIGNED_CHILDREN,
                Permission::PROCESS_PAYMENTS,
            ],
            Role::PARENT_ROLE => [
                Permission::VIEW_OWN_CHILDREN,
                Permission::PAY_INVOICES,
                Permission::MESSAGE_DAYCARE_CENTER
            ]
        ];

        $roles = Role::all();
        $permissions = Permission::all();
        foreach ($data as $role_name => $role_permission_group) {
            $roles->where('name', $role_name)->first()->permissions()
                ->sync($permissions->whereIn('name', $role_permission_group)->pluck('id'));
        }
    }
}
