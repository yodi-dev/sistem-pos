<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Supplier::create([
        //     'name' => 'Toko Hartono',
        // ]);

        // Supplier::create([
        //     'name' => 'Toko Kartini',
        // ]);

        DB::table('product_supplier')->insert([
            ['product_id' => 14, 'supplier_id' => 1],
            // ['product_id' => 1, 'supplier_id' => 2],
            ['product_id' => 15, 'supplier_id' => 1],
        ]);
    }
}
