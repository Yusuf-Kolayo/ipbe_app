<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File; 
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;  
use App\Models\Business_info;

class ShopController extends BaseController
{
    
    public $title = 'shop';


    public function __construct() {
      
    }



    // loads up homepage
    public function home()
    { 
        $business_info = Business_info::where('id', '>', '0')->get()[0];
        return view('shop.home', compact('business_info'));
    }


    // loads up shop page
    public function shop()
    { 
        $business_info = Business_info::where('id', '>', '0')->get()[0];
        return view('shop.shop', compact('business_info'));
    }





        
}