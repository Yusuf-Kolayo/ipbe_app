<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
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


    // loads up register_login page
    public function register_login()
    {   $store_data = $this->store_data;
        $store_sliders = Store_slider::where('status', 'active')->orderBy('position', 'asc')->get();
        return view('shop.register_login', compact('store_sliders', 'store_data'));
    }


    public function login_submit (Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
   
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('dashboard');
        }
  
        return redirect("register_login")->withSuccess('Login details are not valid');
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


        // fetch product details
        // public function add_to_cart (Request $request)
        // {    
        //     $product_id = $request['product_id']; 
        //     // dd($request);
        //     if ($request->cookie('cart')) {
        //         $cart_cookie = $request->cookie('cart');
        //     }
        //     $cart_cookie = '{0:'.$product_id.',}'; $minutes = 20;
        //     Cookie::queue('cart', $cart_cookie, $minutes);
        //     return 'success';
        // }



        // register buy attempt
        public function buy (Request $request, $purchase_type, $product_id)
        {   
           $purchase_attempt = $purchase_type.'::'.$product_id; $minutes = 120;
           Cookie::queue('purchase_attempt', $purchase_attempt, $minutes); 
           return redirect()->route('register_login');
        }
        
}