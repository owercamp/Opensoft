<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\MatrixEPP;
use Faker\Generator as Faker;

$factory->define(MatrixEPP::class, function (Faker $faker) {
  return [
    "meDoc" => $faker->numberBetween(8, 21),
    "meEPP" => $faker->text(30),
    "meDes" => $faker->text(100),
    "meNor" => $faker->text(100),
    "meObs" => $faker->text(100),
    "meFil" => $faker->text(15)
  ];
});
