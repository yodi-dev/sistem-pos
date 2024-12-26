<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'payment_method',
        'total_price',
        'total_paid',
        'change_due',
        'debt',
        'debt_status',
    ];

    protected $casts = [
        'date' => 'date'
    ];


    public function transactionItems()
    {
        return $this->hasMany(TransactionItem::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function getFormattedDateAttribute()
    {
        return Carbon::parse($this->date)->translatedFormat('d/m/y');
    }
}
