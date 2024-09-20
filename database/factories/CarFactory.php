<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Car>
 */
class CarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    { return [
        'model' => $this->faker->word(),
        'image' => $this->faker->imageUrl(),
        'mileage' => $this->faker->numberBetween(1000, 100000) . ' km',
        'color' => $this->faker->safeColorName(),
        'status' => $this->faker->randomElement(['new', 'used']),
        'gear' => $this->faker->randomElement(['manual', 'automatic']),
        'engine' => $this->faker->numberBetween(1000, 5000),
        'speed' => $this->faker->numberBetween(100, 300),
        'quantity' => $this->faker->numberBetween(1, 10),
        'year' => $this->faker->year(),
        'details' => $this->faker->paragraph(),
        'fuel' => $this->faker->randomElement(['petrol', 'diesel', 'electric']),
        'sumE' => $this->faker->randomFloat(2, 0, 5),
        'numE' => $this->faker->numberBetween(0, 100),
        'category_id' => Category::factory(),
        'company_id' => Company::factory(),
        'priceC' => $this->faker->numberBetween(10000, 50000),
        'priceI' => $this->faker->numberBetween(12000, 55000),
    ];
    }
}
