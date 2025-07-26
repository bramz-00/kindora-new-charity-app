<?php

namespace Database\Factories;

use App\Models\Jackpot;
use App\Models\Organisation;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Jackpot>
 */
class JackpotFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Jackpot::class;
    public function definition(): array
    {
       
   
        $start = $this->faker->dateTimeBetween('-1 month', 'now');
        $end = (clone $start)->modify('+1 month');

        return [
            'organisation_id' => Organisation::factory(), // ou un ID fixe si tu préfères
            'created_by_id' => User::factory(),
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(),
            'target_amount' => $this->faker->numberBetween(1000, 50000),
            'collected_amount' => $this->faker->numberBetween(0, 30000),
            'start_date' => $start->format('Y-m-d'),
            'ends_at' => $end->format('Y-m-d'),
            'status' => $this->faker->randomElement(['pending', 'active', 'completed', 'cancelled']),
            'is_active' => $this->faker->boolean(90), // 90% de chance que ce soit actif
        ];
    
    }
}
