<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\Supplier;
use App\Models\WholesaleItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Wholesale extends Model
{
    use HasFactory;

    protected $fillable = ['supplier_id', 'date'];

    protected $casts = [
        'date' => 'date'
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function wholesaleItems()
    {
        return $this->hasMany(WholesaleItem::class);
    }

    public function getFormattedDateAttribute()
    {
        return Carbon::parse($this->date)->translatedFormat('d F Y');
    }
}
