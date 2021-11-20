<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model; 

class Category extends Model
{
    use HasFactory;
    protected $guarded = [];
 
    public function parent() {
        return $this->belongsTo('App\Models\Category', 'parent_id', 'id');
    } 


    public function children () {
        return $this->hasMany('App\Models\Category', 'parent_id', 'id');
    } 

    public function products () {
        return $this->hasMany('App\Models\Product', 'main_category_id', 'id');
    }

    public function cat_name_hard () {
        return strtolower(str_replace(' ','-',$this->cat_name));
    }

}
