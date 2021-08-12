<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'hrd_D001_Id' => $this->faker->randomDigitNotNull,
        'product_description_id' => $this->faker->randomDigitNotNull,
        'product_line_id' => $this->faker->randomDigitNotNull,
        'product_group_id' => $this->faker->randomDigitNotNull,
        'product_utilization_id' => $this->faker->randomDigitNotNull,
        'code' => $this->faker->word,
        'reference' => $this->faker->word,
        'technical_data' => $this->faker->text,
        'application' => $this->faker->word,
        'commercial_description' => $this->faker->word,
        'unit_weight_kg' => $this->faker->word,
        'development_flag' => $this->faker->word,
        'development_date' => $this->faker->word,
        'code_formatted' => $this->faker->word,
        'reference_formatted' => $this->faker->word,
        'code_redirect' => $this->faker->word
        ];
    }
}
