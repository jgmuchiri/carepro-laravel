<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Staff::class, function (Faker $faker) {
    $contents = file_get_contents($faker->imageUrl(400, 400, 'people'));
    return [
        'user_id' => function () {
            return factory(App\User::class)->create()->id;
        },
        'photo_uri' => function () use ($contents) {
            $img = Image::make($contents)->encode('jpg');
            $hash = md5($img->__toString());
            $photo_uri = Storage::put('public/parent-images/'.$hash.'.jpg', $img);

            return str_replace("/storage/", "", Storage::url('public/parent-images/'.$hash.'.jpg'));
        },
        'date_of_birth' => $faker->date($format = 'Y-m-d', $max = '2000-01-01'),
        'is_active' => true,
    ];
});
