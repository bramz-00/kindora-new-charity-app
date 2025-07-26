<?php

namespace Database\Factories;

use App\Models\Organisation;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrganisationFactory extends Factory
{
    protected $model = Organisation::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->company(),
            'registration_number' => strtoupper($this->faker->bothify('ORG-####-####')),
            'registration_date' => $this->faker->date(),
            'description' => $this->faker->paragraph(),
            'legal_status' => $this->faker->randomElement(['association', 'ONG', 'coopérative']),
            'email' => $this->faker->unique()->companyEmail(),
            'website' => $this->faker->url(),
            'phone' => $this->faker->phoneNumber(),
            'address' => $this->faker->address(),
            'country' => $this->faker->country(),
            'verified' => $this->faker->boolean(70), // 70% vérifié
            'logo' => $this->faker->imageUrl(200, 200, 'business', true, 'org'),
            'president_id' => User::factory(), // ou fixe si pas besoin dynamique
            'is_active' => $this->faker->boolean(90),
        ];
    }
}
