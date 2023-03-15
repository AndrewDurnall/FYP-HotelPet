<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pets extends Model
{
    // validating the data as it is passed the database
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'petName',
        'petAge',
        'species',
        'breed',
        'vetName',
        'vetNumber',
        'microChip',
        'vaccinationDate',
        'feedingRequirements',
        'avoidedFood',
        'medicationDetails',
    ];

    // assigning the database relation of a pet belonging to a customer
    public function customer(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

}
