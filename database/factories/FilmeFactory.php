<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Filme;
use Faker\Generator as Faker;

$factory->define(Filme::class, function (Faker $faker) {

    return [
        'titulo' => $faker->word,
        'capa' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
