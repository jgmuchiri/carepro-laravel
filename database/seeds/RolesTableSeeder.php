<?php

use App\Models\Permissions\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            Role::ADMIN_ROLE,
            Role::TENANT_ROLE,
            Role::STAFF_ROLE,
            Role::PARENT_ROLE
        ];

        foreach ($data as $role_name) {
            Role::create(['name' => $role_name]);
        }
    }
}
