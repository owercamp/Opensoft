<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Documentmanagerial;
use Faker\Generator as Faker;

$factory->define(Documentmanagerial::class, function (Faker $faker) {
    return [
        'domName' => $faker->name,
        'domCode' => $faker->bothify('##??-??##-#?#?'),
        'domVersion' => $faker->bothify('?###'),
        'domDate' => $faker->dateTime($max = 'now', $timezone = null)
    ];
});
