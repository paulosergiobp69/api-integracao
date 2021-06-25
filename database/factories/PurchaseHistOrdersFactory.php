<?php
namespace Database\Factories;

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\PurchaseHistOrders;
use Faker\Generator as Faker;

$factory->define(PurchaseHistOrders::class, function (Faker $faker) {

    return [
        'HRD_T011_Id' => $faker->randomDigitNotNull,
        'HRD_T012_Id' => $faker->randomDigitNotNull,
        'HRD_T012_D009_Id' => $faker->randomDigitNotNull,
        'HRD_T011_C007_Id' => $faker->randomDigitNotNull,
        'HRD_T011_C004_Id' => $faker->randomDigitNotNull,
        'HRD_T012_Quantidade' => $faker->randomDigitNotNull,
        'HRD_Quantidade_Pac' => $faker->randomDigitNotNull,
        'HRD_Saldo' => $faker->randomDigitNotNull,
        'HRD_T012_Valor_Custo_Unitario' => $faker->word,
        'HRD_Status' => $faker->word,
        'HRD_Data_Lancamento' => $faker->date('Y-m-d H:i:s'),
        'created_by' => $faker->randomDigitNotNull,
        'updated_by' => $faker->randomDigitNotNull,
        'deleted_by' => $faker->randomDigitNotNull,
        'deleted_at' => $faker->date('Y-m-d H:i:s'),
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
