<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function brand() {
        return $this->belongsTo('App\Models\Brand', 'brand_id', 'id');
    } 

    public function main_category() {
        return $this->belongsTo('App\Models\Category', 'main_category_id', 'id');
    } 

    public function sub_category() {
        return $this->belongsTo('App\Models\Category', 'sub_category_id', 'id');
    } 
}
