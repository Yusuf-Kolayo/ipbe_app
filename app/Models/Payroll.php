<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payroll extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function user() {
        return $this->hasOne(User::class, 'user_id', 'employee_id');
    }
}
