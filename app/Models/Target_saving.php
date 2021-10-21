<?php

namespace App\Models;

<<<<<<< HEAD
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Target_saving extends Model
{
    use HasFactory;
    public function client() {
        return $this->belongsTo('App\Models\Client', 'client_id', 'client_id');
    } 
=======
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
>>>>>>> 69208214d7e57e44837c74e6ba0a0cde8c3805e9
}
