<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pens extends Model
{
    use HasFactory;

    protected $table = 'pens';

    protected $fillable = [
        'penNumber',
        'description',
    ];

    public function bookings()
    {
        return $this->hasMany(Bookings::class);
    }

    public function scopeAvailableBetween($query, $start, $end)
    {
        return $query->whereDoesntHave('bookings', function ($query) use ($start, $end) {
            $query->where('startDate', '<', $end)
                ->where('endDate', '>', $start);
        });
    }
}
