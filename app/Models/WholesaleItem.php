<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WholesaleItem extends Model
{
    use HasFactory;

    protected $fillable = ['wholesale_id', 'product_id', 'quantity', 'unit', 'total_stock'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function wholesale()
    {
        return $this->belongsTo(Wholesale::class);
    }
}
