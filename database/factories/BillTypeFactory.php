<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BillType>
 */
class BillTypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'code' => fake()->numerify('BT######'),
            'name' => fake()->sentence(2),
            'amount' => fake()->randomNumber(5),
            'description' => fake()->sentence(),
        ];
    }
}
