<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('secret12'),
        ]);

        User::create([
            'name' => 'Cashier User',
            'email' => 'cashier@example.com',
            'password' => Hash::make('secret12'),
        ]);
    }
}
