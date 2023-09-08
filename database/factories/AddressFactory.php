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
    public function definition(): array
    {
        return [
            'main' => false,
            'address' => fake()->address(),
            'neighborhood' => fake()->streetAddress(),
            'address_number' => '123',
            'complement' => 'Complemento de teste',
            'city' => fake()->city()
        ];
    }
}
