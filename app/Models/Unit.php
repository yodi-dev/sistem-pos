<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'name', 'multiplier'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
