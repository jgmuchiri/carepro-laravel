<?php

use Illuminate\Database\Seeder;

class StatusesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'Active',
            'Inactive',
            'Pending Approval'
        ];

        foreach ($data as $name) {
            \App\Models\Status::create(['name' => $name]);
        }
    }
}
