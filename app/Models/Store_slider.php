<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Slider_content;

class Store_slider extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function slider_content() {
        return $this->hasMany(Slider_content::class, 'slider_id', 'slider_id');
    }
   
}