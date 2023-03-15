<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{

    // assigning the database relation of a customer that can have many pets
    public function pets()
    {
        return $this->hasMany(Pets::class);
    }

    // assigning the database relation of a customer that can have many bookings
    public function bookings()
    {
        return $this->hasMany(Bookings::class);
    }

    // function to get all the customers data from the database
    public static function getCustomers()
    {
        return static::all();
    }

    use HasFactory;

    // validating the data as it is passed the database
    protected $table = 'customers';

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
        'emergencyNumber',];
}
