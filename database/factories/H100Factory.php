<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\H100;
use Faker\Generator as Faker;

$factory->define(H100::class, function (Faker $faker) {

    return [
        'H100_T012_Id' => $faker->word,
        'H100_C007_Id' => $faker->word,
        'H100_Quantidade' => $faker->word,
        'H100_Quantidade_Pac' => $faker->word,
        'H100_Saldo' => $faker->word,
        'H100_Valor_Unitario' => $faker->word,
        'H100_Status' => $faker->word,
        'H100_Data_Lancamento' => $faker->date('Y-m-d H:i:s'),
        'deleted_at' => $faker->date('Y-m-d H:i:s'),
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
