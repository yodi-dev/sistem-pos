<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Expense extends Model
{
    use HasFactory;

    protected $fillable = ['date', 'expense', 'amount', 'note'];

    protected $casts = [
        'date' => 'date'
    ];

    public function getFormattedDateAttribute()
    {
        return Carbon::parse($this->date)->translatedFormat('d M y');
    }
}
