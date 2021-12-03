<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB; 
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File; 
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;  
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;  
use App\Models\Business_info;
use App\Models\Store_slider;
use App\Models\Category;
use App\Models\Product;
use App\Models\Client;
use App\Models\Activity;
use App\Models\User;
use App\Models\Notification;



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



    public function shop_sign_out () {

        Session::flush();
        Auth::logout();
  
        return redirect("register_login");
    }



    public function register_submit (Request $request)
    { 

        DB::transaction(function () {

        $data = request()->validate([
            'first_name' => ['required', 'string', 'max:55'],
            'last_name' => ['required', 'string', 'max:55'],
            'other_name' => ['nullable', 'string', 'max:55'],
            'phone' => ['required', 'string', 'max:55', 'unique:clients'],
            'email' => ['required', 'string', 'email', 'max:99', 'unique:users'],
            'country' => ['required', 'string', 'max:200'],
            'state' => ['required', 'string', 'max:200'],
            'address' => ['required', 'string', 'max:200'],
            'username' => ['required', 'string', 'max:55', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'same:confirm_password'],
            'confirm_password' => ['required', 'string', 'min:6']
        ]); 

        $sql = DB::select("show table status like 'users'");
        $next_id = 100 + $sql[0]->Auto_increment;   $usr_type = 'usr_client';
        $client_id = 'CLT-'.$next_id;   
        
        $client = Client::create([  
            'client_type' => 'self_reg',
            'client_id' => $client_id, 
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'], 
            'phone' => $data['phone'],
            'country' => $data['country'], 
            'state' => $data['state'],
            'address' => $data['address']
        ]);

        $user = User::create ([
            'user_id' => $client_id,
            'status' => 'active',
            'username' => strtolower($data['username']),
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'usr_type' => $usr_type
        ]);
    
      
        // notify admins of this activity
        $type = 'new_client_reg';
        $message = '</b>New client <b> '.strtolower($data['username']).' ['.$client_id.']</b> registered from store sign-up form';
        $admninistrators = User::where('usr_type', 'usr_admin')->get();
        foreach ($admninistrators as $key => $admninistrator) {
            $notification = Notification::create ([
                'actor_id' => $client_id,
                'receiver_id' => $admninistrator->user_id,
                'type' => $type,
                'message' => $message,
                'status' => 'sent',
                'main_foreign_key' => $client_id
            ]);
    
        }


       });


        // $credentials = request()->validate([
        //     'email' => ['required', 'email'],
        //     'password' => ['required'],
        // ]);

        $credentials = request()->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('dashboard');
        }

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


 


    // register buy attempt
    public function buy (Request $request, $purchase_type, $product_id)
    {   
        $purchase_attempt = $purchase_type.'::'.$product_id; $minutes = 120;
        Cookie::queue('purchase_attempt', $purchase_attempt, $minutes); 
        return redirect()->route('register_login');
    }



    // checkout_buy_now
    public function checkout_buy_now (Request $request)
    {    
        $store_data = $this->store_data;

        if ($request->cookie('purchase_attempt')) { 
            $product_id = explode('::',$request->cookie('purchase_attempt'))[1]; 
            $product_attp = Product::where('product_id', $product_id)->first();
            return view('shop.checkout_buy_now', compact('product_attp', 'store_data'));
        }  else {   
            return redirect()->route('homepage');
        }
     
    }


    // checkout_installment
    public function checkout_installment (Request $request)
    {    
        $store_data = $this->store_data;

        if ($request->cookie('purchase_attempt')) { 
            $product_id = explode('::',$request->cookie('purchase_attempt'))[1]; 
            $product_attp = Product::where('product_id', $product_id)->first();
            return view('shop.checkout_installment', compact('product_attp', 'store_data'));
        }  else {   
            return redirect()->route('homepage');
        }
     
    }



        
}
