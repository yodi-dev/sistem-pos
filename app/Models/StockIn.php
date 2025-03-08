<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockIn extends Model
{
    use HasFactory;

    protected $fillable = ['supplier_id', 'date'];

    public function details()
    {
        return $this->hasMany(StockInDetail::class);
    }
}
