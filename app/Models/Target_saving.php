<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Notification;

class Target_saving extends Authenticatable
{
    use HasFactory, Notifiable;
 
    

    public function client() {
        return $this->belongsTo('App\Models\Client', 'client_id', 'client_id');
    }  
}
