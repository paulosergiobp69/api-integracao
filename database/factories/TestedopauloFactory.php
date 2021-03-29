<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Testedopaulo;
use Faker\Generator as Faker;

$factory->define(Testedopaulo::class, function (Faker $faker) {

    return [
        'nome' => $faker->word,
        'image' => $faker->word,
        'old_id' => $faker->randomDigitNotNull,
        'created_by' => $faker->randomDigitNotNull,
        'updated_by' => $faker->randomDigitNotNull,
        'deleted_by' => $faker->randomDigitNotNull,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
