<?php
namespace Database\Factories;

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\PurchaseHistIncomingInvoice;
use Faker\Generator as Faker;

$factory->define(PurchaseHistIncomingInvoice::class, function (Faker $faker) {

    return [
        'PHO_Id' => $faker->word,
        'HRD_T014_Id' => $faker->randomDigitNotNull,
        'HRD_Quantidade' => $faker->randomDigitNotNull,
        'HRD_Valor_Custo_Unitario' => $faker->word,
        'HRD_Flag_Cancelado' => $faker->word,
        'HRD_Data_Lancamento' => $faker->date('Y-m-d H:i:s'),
        'created_by' => $faker->randomDigitNotNull,
        'updated_by' => $faker->randomDigitNotNull,
        'deleted_by' => $faker->randomDigitNotNull,
        'deleted_at' => $faker->date('Y-m-d H:i:s'),
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
