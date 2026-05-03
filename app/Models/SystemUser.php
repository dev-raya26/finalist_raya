<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SystemUser extends Authenticatable
{
     use HasFactory, Notifiable;
     protected $fillable = [
        'firstname','middlename','lastname', 'email', 'phone', 'password', 'role', 'status'
    ];

    public function buildings()
    {
        return $this->hasMany(Building::class, 'landlord_id');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'customer_id');
    }
}
