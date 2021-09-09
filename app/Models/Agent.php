<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Client;
use App\Models\Catchment;
use App\Models\Transaction;
use App\Models\Product_purchase_session;

class Agent extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function user() {
        return $this->hasOne(User::class, 'user_id', 'agent_id');
    }

    public function catchment() {
        return $this->hasOne(Catchment::class, 'catchment_id', 'catchment_id');
    }

    public function client() {
        return $this->hasMany(Client::class, 'agent_id', 'agent_id');
    }

    public function transaction() {
        return $this->hasMany(Transaction::class, 'agent_id', 'agent_id');
    }

    public function product_purchase_session() {
        return $this->hasMany(Product_purchase_session::class, 'agent_id', 'agent_id');
    }

    
}
