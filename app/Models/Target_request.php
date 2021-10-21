<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Target_saving;
class Target_request extends Model
{
    use HasFactory;
    protected $primaryKey='request_id';

    public function target_saving() {
        return $this->hasOne(Target_saving::class, 'id', 'target_saving_id');
    }
}
