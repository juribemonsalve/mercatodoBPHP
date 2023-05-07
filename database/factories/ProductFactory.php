<?php

namespace Database\Factories;

use App\Models\Categories;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    public function definition()
    {
        return [
            'cover_img' => $this->faker->imageUrl(640, 480, $this->faker->randomElement(['Technology', 'Cell phones and accessories', 'accessories electric home'])),
            'name' => $this->faker->unique()->regexify('[A-Za-z]{10}'),
            'description' => $this->faker->unique()->regexify('[A-Za-z]{10}'),
            'price' => $this->faker->randomFloat(0, 0, 100000),
            'quantity' => $this->faker->numberBetween(0, 100),
            'category_id' => Categories::inRandomOrder()->first()->id,
            'status' => $this->faker->randomElement(['active', 'disabled']),
        ];
    }
}
