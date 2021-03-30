<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\H101;
use Faker\Generator as Faker;

$factory->define(H101::class, function (Faker $faker) {

    return [
        'H101_H100_Id' => $faker->word,
        'H101_T014_Id' => $faker->word,
        'H101_Quantidade' => $faker->word,
        'H101_Flag_Cancelado' => $faker->word,
        'H101_Valor_Unitario' => $faker->word,
        'H101_Data_Lancamento' => $faker->date('Y-m-d H:i:s'),
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s'),
        'deleted_at' => $faker->date('Y-m-d H:i:s'),
        'created_by' => $faker->randomDigitNotNull,
        'updated_by' => $faker->randomDigitNotNull,
        'deleted_by' => $faker->randomDigitNotNull
    ];
});
