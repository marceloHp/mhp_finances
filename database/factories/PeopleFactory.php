<?php

namespace Database\Factories;

use App\Models\Address;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\People>
 */
class PeopleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     * @throws \Exception
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'type' => 'employee',
            'identifier' => random_int(8, 8),
            'address_id' => Address::query()->get('id')->random(),
            'people_type' => 'cpf',
            'cellphone' => fake()->phoneNumber(),
            'active' => true,
            'born_date' => fake()->date()
        ];
    }
}
