<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Bill>
 */
class BillFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $status = fake()->randomElement(['created','submited','paid','canceled']);
        return [
            'code' => fake()->numerify('IV######'),
            'user_id'=> null,
            'type_id'=> null,
            'bill_amount'=> fake()->randomNumber(5),
            'pay_amount'=> fake()->randomNumber(5),
            'pay_date'=> fake()->dateTimeThisYear(),
            'user_note'=> fake()->sentence(),
            'admin_note'=> fake()->sentence(),
            'status'=> $status,
            'approve_at'=> $status=='paid'? now() : null,
            'approve_by'=> $status=='paid'? \App\Models\User::factory()->create(['role'=>'admin'])->id : null,
            'created_by'=> null,
        ];
    }
}
