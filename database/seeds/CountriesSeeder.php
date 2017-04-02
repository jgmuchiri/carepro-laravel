<?php

use Illuminate\Database\Seeder;

use App\Models\Addresses\Country;

class CountriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['name' => 'United States', 'abbreviation' => 'US']
        ];

        foreach ($data as $data)
        {
            Country::create($data);
        }
    }
}
