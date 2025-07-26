<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Books',
            'Clothing',
            'Electronics',
            'Furniture',
            'Toys',
            'Sports Equipment',
            'Home Appliances',
            'School Supplies',
            'Kitchenware',
            'Miscellaneous',
        ];

        foreach ($categories as $name) {
            Category::create([
                'name' => $name,
                'slug' => Str::slug($name),
                'is_active' => true,
            ]);
        }
                // Category::factory()->count(10)->create();

    }
}
