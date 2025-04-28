<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        /* 'name', 'price', 'description', 'stock', 'image', 'category_id' */
        return [
            'name' => $this->faker->word(),
            'price' => $this->faker->randomFloat(2, 0, 100),
            'description' => $this->faker->text(),
            'stock' => $this->faker->randomNumber(),
            'category_id' => $this->faker->randomNumber(),
        ];
    }
}
