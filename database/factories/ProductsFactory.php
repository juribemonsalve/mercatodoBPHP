<?php

namespace Database\Factories;

use App\Models\Categories;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Products>
 */
class ProductsFactory extends Factory
{
    public function definition()
    {
        return [
            'name' => $this->faker->unique()->text(10),
            'description' => $this->faker->text(30),
            'price' => $this->faker->numberBetween(0, 100000),
            'quantity' => $this->faker->numberBetween(0, 100),
            'category_id' => Categories::inRandomOrder()->first()->id,
            'status' => $this->faker->randomElement(['active', 'disabled']),
        ];
    }
}
