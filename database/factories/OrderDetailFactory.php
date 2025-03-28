<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderDetail>
 */
class OrderDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
       'order_id' => $this->faker->numberBetween(1, Order::count()),
        'product_id' => $this->faker->unique()->numberBetween(1, Product::count()),
        'quantity' => $this->faker->numberBetween(1, 10),
        'price' => $this->faker->randomFloat(2, 1, 1000),
        ];
    }
}
