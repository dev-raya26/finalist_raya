<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
     protected $fillable = [
        'customer_id', 'room_id', 'start_date', 'end_date', 'status','amount'
    ];

    public function customer()
    {
        return $this->belongsTo(SystemUser::class, 'customer_id');
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}
