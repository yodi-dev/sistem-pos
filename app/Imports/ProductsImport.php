<?php

namespace App\Imports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;

class ProductsImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Product([
            'code'     => $row[0],
            'name'     => $row[1],
            'category_id'    => $row[2],
            'purchase_price'    => $row[3],
            'retail_price'    => $row[4],
            'wholesale_price'    => $row[5],
            'agent_price'    => $row[6],
            'reseller_price'    => $row[7],
            'stock'    => $row[8],
        ]);
    }
}
