<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pets extends Model
{
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

    public function customer(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

}
