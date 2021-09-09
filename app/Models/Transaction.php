<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User; 

class transaction extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function product_purchase_session () {
        return $this->hasOne ('App\Models\Product_purchase_session', 'pps_id', 'pps_id');
    } 
 
}
