<?php

use App\Models\Permissions\Role;
use App\User;
use Illuminate\Database\Seeder;

class AdminUserAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create(
            [
                'name' => \Config::get('auth.admin_user.name'),
                'email' => \Config::get('auth.admin_user.email'),
                'password' => bcrypt(\Config::get('auth.admin_user.password')),
                'confirmed' => true
            ]
        );

        $user->roles()->sync([Role::whereName(Role::ADMIN_ROLE)->first()->id]);
    }
}
