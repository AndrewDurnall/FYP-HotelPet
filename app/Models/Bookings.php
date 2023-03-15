<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bookings extends Model
{
    use HasFactory;

    // assigning the database relation of a booking belonging to a pen
    public function pens(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Pens::class);
    }

    // assigning the database relation of a booking belonging to a customer
    public function customer(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }


    // validating the data as it is passed the database
    protected $table = 'bookings';

    protected $fillable = [
        'pens_id',
        'customer_id',
        'startDate',
        'endDate',
    ];
}
