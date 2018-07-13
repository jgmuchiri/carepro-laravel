<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Child::class, function (Faker $faker) {
    $contents = file_get_contents($faker->imageUrl(400, 400, 'people'));
    $user_id = App\Models\Staff::all()->random()->user_id;
    return [
        'name' => $faker->firstName. " ".$faker->lastName,
        'nickname' => $faker->firstName,
        'ssn' => $faker->numberBetween($min = 10000, $max = 999999),
        'nickname' => $faker->firstName,
        'dob' => $faker->date($format = 'Y-m-d', $max = '2000-01-01'),
        'gender_id' => function () {
            return App\Models\Gender::all()->random()->id;
        },
        'blood_type_id' => function () {
            return App\Models\BloodType::all()->random()->id;
        },
        'pin' => $faker->numberBetween($min = 1000, $max = 9999),
        'photo' => function () use ($contents) {
            $img = Image::make($contents)->encode('jpg');
            $hash = md5($img->__toString());
            $photo_uri = Storage::put('public/parent-images/'.$hash.'.jpg', $img);

            return str_replace("/storage/", "", Storage::url('public/parent-images/'.$hash.'.jpg'));
        },
        'status_id' => function () {
            return App\Models\Status::all()->random()->id;
        },
        'created_by_user_id' => $user_id,
        'updated_by_user_id' => $user_id,
        'religion_id' => function () {
            return App\Models\Religion::all()->random()->id;
        },
        'ethnicity_id' => function () {
            return App\Models\Ethnicity::all()->random()->id;
        },
        'is_active' => true,
    ];
});
