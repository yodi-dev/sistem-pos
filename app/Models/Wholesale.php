<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wholesale extends Model
{
    use HasFactory;

    protected $fillable = ['supplier_id', 'date'];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function wholesaleItems()
    {
        return $this->hasMany(WholesaleItem::class);
    }
}
