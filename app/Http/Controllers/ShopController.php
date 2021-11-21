<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File; 
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;  
use App\Models\Business_info;
use App\Models\Store_slider;
use App\Models\Category;
use App\Models\Product;


class ShopController extends BaseController
{
    
    public $title = 'shop';
    public $store_data;
    

    public function __construct() {
        $business_info = Business_info::where('id', '>', '0')->get()[0];
        $main_categories = Category::where('parent_id', 0)->get();
        $this->store_data = ['business_info'=>$business_info, 'main_categories'=>$main_categories];
    }



    // loads up homepage
    public function home()
    {   $store_data = $this->store_data;
        $store_sliders = Store_slider::where('status', 'active')->orderBy('position', 'asc')->get();
        return view('shop.home', compact('store_sliders', 'store_data'));
    }


    // loads up shop page
    public function shop()
    {   
        $store_data = $this->store_data;
        return view('shop.shop', compact('store_data'));
    }



    // fetch product details
    public function product_quickshop (Request $request)
    {   
        $product_id = $request['product_id'];
        $product = Product::where('product_id', $product_id)->first();
        return view('shop.product_quickshop', compact('product'));
    }
        
}