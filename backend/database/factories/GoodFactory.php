<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Good>
 */
class GoodFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
            return [
            'title' => $this->faker->words(3, true),
            'description' => $this->faker->paragraph(),
            'slug' => $this->faker->unique()->slug(),
            'state' => $this->faker->randomElement(['new', 'used', 'damaged']),
            'exchange_condition' => $this->faker->sentence(),
            'owner_id' => User::factory(), // Assumes User factory exists
            'category_id' => Category::factory(), // Assumes Category factory exists
            'type' => $this->faker->randomElement(['donation', 'exchange']),
            'good_uuid' => null, // Will be generated in model event
            'is_active' => $this->faker->boolean(),
            'status' => $this->faker->randomElement(['pending', 'approved', 'rejected']),
        ];
    }
}
