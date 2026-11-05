<?php

namespace Database\Factories;

use App\Models\Destination;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Event>
 */
class DestinationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [

                'name' => $this->faker->name(),
                'description' => $this->faker->optional()->paragraph(),
                'country' => $this->faker->country(),
                'city' => $this->faker->city(),
                'address' => $this->faker->optional()->address(),
                'price' => $this->faker->optional()->randomFloat(2, 50, 2000),
                'status' => $this->faker->boolean(80), // 80% de probabilidad de ser true (1)
                'registered_by' => $this->faker->name(),
    ];
            
        }
}
