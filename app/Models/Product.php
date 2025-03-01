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
        'category_id',
        'purchase_price',
        'retail_price',
        'wholesale_price',
        'agent_price',
        'reseller_price',
        'stock',
        'location',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function transactionItems()
    {
        return $this->hasMany(TransactionItem::class);
    }

    public function wholesaleItems()
    {
        return $this->hasMany(WholesaleItem::class);
    }

    public function units()
    {
        return $this->hasMany(Unit::class);
    }

    public function stockInDetails()
    {
        return $this->hasMany(StockInDetail::class);
    }

    public function suppliers()
    {
        return $this->belongsToMany(Supplier::class);
    }

    public function wholesale()
    {
        return $this->belongsTo(Wholesale::class);
    }
}
