<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Address>
 */
class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => 1,
            'city' => fake()->city(),
            'district' => fake()->city(),
            'zipcode'=> fake()->randomDigitNotZero(),
            'address' => fake()->address(),
            'is_default' => fake()->boolean(),
        ];
    }
}
