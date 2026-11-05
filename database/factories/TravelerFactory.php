<?php

namespace Database\Factories;


use App\Models\Traveler;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Event>
 */
class TravelerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
            'document' => $this->faker->numerify('########'),
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->phoneNumber(),
             'address' => $this->faker->address(),
            'status' => '1',
            'registered_by' => $this->faker->name(),
           
        ];
    }
}
