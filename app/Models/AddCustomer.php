<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddCustomer extends Model
{

    use HasFactory;

    // validating the data as it is passed the database
    protected $fillable = [
        'firstName',
        'lastName',
        'houseNumberOrName',
        'addressLine1',
        'addressLine2',
        'townCity',
        'postCode',
        'telephone',
        'email',
        'emergencyName',
        'emergencyNumber',
    ];
}
