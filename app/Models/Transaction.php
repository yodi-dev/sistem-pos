<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = ['total_price', 'total_paid', 'change_due', 'transaction_date'];

    public function items()
    {
        return $this->hasMany(TransactionItem::class);
    }
}
