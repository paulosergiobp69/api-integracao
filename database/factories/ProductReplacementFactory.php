<?php

namespace Database\Factories;

use App\Models\ProductReplacement;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductReplacementFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProductReplacement::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'product_id' => $this->faker->randomDigitNotNull,
        'product_utilization_id' => $this->faker->randomDigitNotNull,
        'user_hrd_id' => $this->faker->randomDigitNotNull,
        'code_new' => $this->faker->word,
        'code_old' => $this->faker->word,
        'date_include' => $this->faker->word,
        'code_formatted_old' => $this->faker->word,
        'hrd_D017_Id' => $this->faker->randomDigitNotNull,
        'created_by' => $this->faker->randomDigitNotNull,
        'updated_by' => $this->faker->randomDigitNotNull,
        'deleted_by' => $this->faker->randomDigitNotNull,
        'deleted_at' => $this->faker->date('Y-m-d H:i:s'),
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
