<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        Category::create([
            'name' => 'Makanan',
        ]);

        Category::create([
            'name' => 'Minuman',
        ]);
        Category::create([
            'name' => 'Bumbu',
        ]);

        Category::create([
            'name' => 'Jajan',
        ]);

        Category::create([
            'name' => 'Pakaian',
        ]);
    }
}
