<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    public function pets()
    {
        return $this->hasMany(Pets::class);
    }

    public function bookings()
    {
        return $this->hasMany(Bookings::class);
    }

    public static function getCustomers()
    {
        return static::all();
    }

    use HasFactory;

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
