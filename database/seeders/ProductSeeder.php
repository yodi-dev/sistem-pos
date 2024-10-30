<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();
        $categories = [1, 2, 3, 4, 5];

        for ($i = 0; $i < 50; $i++) {
            Product::create([
                'name' => $faker->word . ' ' . $faker->randomElement(['Minuman', 'Makanan', 'Snack', 'Bumbu', 'Alat Dapur']),
                'price' => $faker->numberBetween(1000, 50000),
                'stock' => $faker->numberBetween(1, 100),
                'description' => $faker->sentence(5),
                'category_id' => $faker->randomElement($categories),
            ]);
        }
    }
}
