<?php

namespace Database\Factories;

use App\Helpers\DateNow;
use App\Models\Destination;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Trip>
 */
class TripFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'destination_id' => 1,
            'price' => $this->faker->randomFloat(2, 100, 1000),
            'available_seats' => $this->faker->numberBetween(10, 50),
            'start_date' => Carbon::now()->addDays(3),
            'end_date' => Carbon::now()->addDays(7)
        ];
    }
}
