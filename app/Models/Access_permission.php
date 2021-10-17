<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User; 




class Access_permission extends Model
{   
    use HasFactory;
    
    protected $guarded = [];


    public function user() {
        return $this->hasOne(User::class, 'user_id', 'user_id');
    }

  
}