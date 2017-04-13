<?php

use App\Models\Permissions\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['name' => Permission::VIEW_TENANT, 'is_admin_only' => true],
            ['name' => Permission::REGISTER_TENANT, 'is_admin_only' => true],
            ['name' => Permission::EDIT_TENANT, 'is_admin_only' => true],
            ['name' => Permission::SEND_PASSWORD_RESET_EMAILS, 'is_admin_only' => true],
            ['name' => Permission::SEND_MESSAGES_TO_TENANTS, 'is_admin_only' => true],
            ['name' => Permission::MANAGE_SUBSCRIPTIONS, 'is_admin_only' => true],
            ['name' => Permission::MANAGE_APPLICATION_SETTINGS, 'is_admin_only' => true],
            ['name' => Permission::MANAGE_STAFF_MEMBERS, 'is_admin_only' => false],
            ['name' => Permission::MANAGE_CHILDREN, 'is_admin_only' => false],
            ['name' => Permission::MANAGE_PARENTS, 'is_admin_only' => false],
            ['name' => Permission::GENERATE_REPORTS, 'is_admin_only' => false],
            ['name' => Permission::MANAGE_ASSIGNED_CHILDREN, 'is_admin_only' => false],
            ['name' => Permission::PROCESS_PAYMENTS, 'is_admin_only' => false],
            ['name' => Permission::VIEW_OWN_CHILDREN, 'is_admin_only' => false],
            ['name' => Permission::PAY_INVOICES, 'is_admin_only' => false],
            ['name' => Permission::MESSAGE_DAYCARE_CENTER, 'is_admin_only' => false]
        ];

        foreach ($data as $record) {
            Permission::create($record);
        }
    }
}
