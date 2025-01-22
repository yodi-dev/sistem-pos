<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DailyReport extends Model
{
    use HasFactory;

    protected $fillable = ['report_date', 'total_income', 'total_outcome', 'opening_savings', 'savings', 'balance', 'opening_balance', 'notes'];

    protected $casts = [
        'report_date' => 'date'
    ];

    public function getFormattedReportDateAttribute()
    {
        return Carbon::parse($this->report_date)->translatedFormat('d/m/y');
    }
}
