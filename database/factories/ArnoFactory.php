<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Arno;
use Faker\Generator as Faker;

$factory->define(Arno::class, function (Faker $faker) {

    return [
        'nome' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s'),
        'deleted_at' => $faker->date('Y-m-d H:i:s')
    ];
});
