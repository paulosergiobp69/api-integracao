<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Testefor;
use Faker\Generator as Faker;

$factory->define(Testefor::class, function (Faker $faker) {

    return [
        'nome' => $faker->word,
        'image' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s'),
        'deleted_at' => $faker->date('Y-m-d H:i:s')
    ];
});
