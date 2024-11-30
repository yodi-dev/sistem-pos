<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'category',
        'purchase_price',
        'reseller_price',
        'agent_price',
        'retail_price',
        'distributor_price',
        'stock',
        'location',
        'supplier',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function transactionItems()
    {
        return $this->hasMany(TransactionItem::class);
    }

    public function units()
    {
        return $this->hasMany(Unit::class);
    }
}
