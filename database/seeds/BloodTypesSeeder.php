<?php

use Illuminate\Database\Seeder;

class BloodTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'A-',
            'A+',
            'B-',
            'B+',
            'AB',
            'O-',
            'O+'
        ];

        foreach ($data as $blood_type) {
            \App\Models\BloodType::create(['blood_type' => $blood_type]);
        }
    }
}
