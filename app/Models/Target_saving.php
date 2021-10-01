<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Target_saving extends Model
{
    use HasFactory;
    public function client() {
        return $this->belongsTo('App\Models\Client', 'client_id', 'client_id');
    } 
}
