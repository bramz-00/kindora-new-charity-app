<?php

namespace Database\Seeders;

use App\Models\Jackpot;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JackpotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Jackpot::factory()->count(10)->create();

    }
}
