<?php

namespace App\Models;
use App\Models\OnlineUsers;
use App\Models\SystemUser;

use Illuminate\Database\Eloquent\Model;

class OnlineUsers extends Model
{
    protected $fillable= [
        'user_id',
    ];
     public function user()
    {
        return $this->belongsTo(SystemUser::class, 'user_id', 'id');
    }

}
