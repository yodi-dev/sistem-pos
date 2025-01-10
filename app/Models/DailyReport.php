<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyReport extends Model
{
    use HasFactory;

    protected $fillable = ['report_date', 'total_income', 'total_outcome', 'savings', 'balance', 'opening_balance', 'notes'];
}
