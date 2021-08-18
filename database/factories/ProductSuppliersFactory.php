<?php

namespace Database\Factories;

use App\Models\ProductSuppliers;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductSuppliersFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProductSuppliers::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'hrd_D049_Id' => $this->faker->randomDigitNotNull,
        'code_supplier' => $this->faker->word,
        'code_supplier_formatted' => $this->faker->word,
        'product_id' => $this->faker->randomDigitNotNull,
        'technical_data' => $this->faker->word,
        'created_by' => $this->faker->randomDigitNotNull,
        'updated_by' => $this->faker->randomDigitNotNull,
        'deleted_by' => $this->faker->randomDigitNotNull,
        'deleted_at' => $this->faker->date('Y-m-d H:i:s'),
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
