<?php

use Illuminate\Database\Seeder;

class EthnicitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'Unknown',
            'Hispanic',
            'Black',
            'White',
            'Asian',
            'Other'
        ];

        foreach ($data as $ethnicity) {
            \App\Models\Ethnicity::create(['name' => $ethnicity]);
        }
    }
}
