<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\SuperHero::class, function (Faker $faker) {
    return [
        'nickname' => $faker->firstName,
        'real_name' => $faker->name,
        'origin_description' => $faker->realText(200, 2),
        'superpowers' => $faker->sentence(6, true),
        'catch_phrase' => $faker->text(200) ,
    ];
});
