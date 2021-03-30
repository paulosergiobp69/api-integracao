<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Telefone;
use Faker\Generator as Faker;

$factory->define(Telefone::class, function (Faker $faker) {

    return [
        'cliente_id' => $faker->word,
        'numero' => $faker->word,
        'deleted_at' => $faker->date('Y-m-d H:i:s'),
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
