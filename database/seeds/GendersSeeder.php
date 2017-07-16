<?php

use Illuminate\Database\Seeder;

class GendersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'Male',
            'Female'
        ];

        foreach ($data as $gender) {
            \App\Models\Gender::create(['name' => $gender]);
        }
    }
}
