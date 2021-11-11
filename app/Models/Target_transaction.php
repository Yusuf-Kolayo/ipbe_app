<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Target_saving;

class Target_transaction extends Model
{
    use HasFactory;
    protected $primaryKey='transaction_id';

    public function target_saving() {
        return $this->belongsTo(Target_saving::class,'target_saving_id','id');
    }
}
