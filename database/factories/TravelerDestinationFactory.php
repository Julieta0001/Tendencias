<?php

namespace Database\Factories;
use App\Models\Traveler;
use App\Models\Destination;
use App\Models\TravelerDestination;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Event>
 */
class TravelerDestinationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'traveler_id' => Traveler::inRandomOrder()->first()?->id ?? Traveler::factory()->create()->id,
            'destination_id' => Destination::inRandomOrder()->first()?->id ?? Destination::factory()->create()->id,
            'travel_date' => $this->faker->dateTimeBetween('now', '+1 month')->format('Y-m-d'),
            'return_date' => $this->faker->optional()->dateTimeBetween('+2 months', '+3 months')?->format('Y-m-d'),
            'price_paid' => $this->faker->optional()->randomFloat(2, 100, 1500),
            'notes' => $this->faker->optional()->sentence(),
            'payment_type' => $this->faker->randomElement(['contado', 'credito']),
             'pending_balance' => $this->faker->optional()->randomFloat(2, 0, 500),
            'registered_by' => $this->faker->name()

        ];
    }
}
