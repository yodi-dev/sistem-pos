<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'name'];

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    public function wholesale()
    {
        return $this->belongsTo(Wholesale::class);
    }
}
