<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Building extends Model
{
     protected $fillable = [
        'landlord_id', 'room_name', 'location', 'description', 'image'
    ];

    public function landlord()
    {
        return $this->belongsTo(SystemUser::class, 'landlord_id');
    }

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }
}
