<?php

namespace Database\Factories;

use App\Models\People;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vehicles>
 */
class VehiclesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name'=> 'Veículo' . random_int(0, 100),
            'identifier' => 'ABC-123',
            'driver' => fake()->name(),
            'active' => true,
            'people_id' => People::query()->get('id')->random()
        ];
    }
}
