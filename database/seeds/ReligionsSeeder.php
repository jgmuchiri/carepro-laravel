<?php

use Illuminate\Database\Seeder;

class ReligionsSeeder extends Seeder
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
            'Christian-protestant',
            'Christian-catholic',
            'Islam',
            'Hindu',
            'Other',
        ];

        foreach ($data as $religion) {
            \App\Models\Religion::create(['name' => $religion]);
        }
    }
}
