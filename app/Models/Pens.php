<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pens extends Model
{
    use HasFactory;

    // validating the data as it is passed the database
    protected $table = 'pens';

    protected $fillable = [
        'penNumber',
        'description',
    ];

    // assigning the database relation of a pen that can have many bookings
    public function bookings()
    {
        return $this->hasMany(Bookings::class);
    }

}
