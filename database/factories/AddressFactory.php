<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Addresses\Address::class, function (Faker $faker) {
    $city_id = App\Models\Addresses\City::firstOrCreate(['name' => $faker->city])->id;
    $state_id = App\Models\Addresses\State::firstOrCreate(['name' => $faker->state])->id;
    $zip_code_id = App\Models\Addresses\ZipCode::firstOrCreate(['zip_code' => $faker->postcode])->id;
    return [
        'address_line_1' => $faker->address,
        'phone' => $faker->e164PhoneNumber,
        'city_id' => $city_id,
        'state_id' => $state_id,
        'zip_code_id' => $zip_code_id,
        'country_id' => function () {
            return App\Models\Addresses\Country::all()->random()->id;
        },
        'address_line_1' => $faker->address,
    ];
});
