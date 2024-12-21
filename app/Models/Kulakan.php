<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kulakan extends Model
{
    use HasFactory;

    public $fillable = ['id_product', 'quantity', 'supplier'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
