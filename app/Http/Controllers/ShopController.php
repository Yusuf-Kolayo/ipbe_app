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
use App\Models\Brand;
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
        $brands = Brand::all();
        $this->store_data = ['business_info'=>$business_info, 'main_categories'=>$main_categories, 'brands'=>$brands];
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







    //  loads up shop page [by categories]
    public function shop_by_categories (Request $request, $cat_id, $slug, $cate)
    {
        $store_data = $this->store_data; 
        $category = Category::where('id', $cat_id)->first();
        if ($cate=='main') {$cate_mode='main_category_id';     $view='shop.shop_by_categories';} 
                      else {$cate_mode='sub_category_id';  $view='shop.shop_by_sub_categories';}

        if ((count($category->products)>0)||(count($category->sub_products)>0)) {  // product found under category
            $h_price = Product::where($cate_mode, $cat_id)->orderBy('price', 'desc')->first()->price; 
            $l_price = Product::where($cate_mode, $cat_id)->orderBy('price', 'asc')->first()->price; 
            $margin = $h_price-$l_price;    $margin_div = (int) $margin/4;

            if ($h_price==$l_price) { 
                $price_array = array($l_price, $h_price);
            } else {
                $a = $l_price; $b = $a + $margin_div ; $c = $b + $margin_div; $d = $c + $margin_div; $e = $h_price;
                $price_array = array($a, $b, $c, $d, $e);
            }
        } else {  // no product found under category
                $price_array = null; 
        }

        return view($view, compact('store_data', 'category', 'price_array'));
    }



    
    //  loads up shop page [vy brands]
    public function shop_by_brands (Request $request, $brand_id, $slug)
    {
        $store_data = $this->store_data;
        $brand = Brand::where('id', $brand_id)->first();

        $order_criteria = 'prd_name';   $order_mode = 'asc';
        $products = Product::where('brand_id', $brand_id)->orderBy($order_criteria, $order_mode)->simplePaginate(10); 

        if (count($products)>0) {  // product found under category
            $h_price = Product::where('brand_id', $brand_id)->orderBy('price', 'desc')->first()->price; 
            $l_price = Product::where('brand_id', $brand_id)->orderBy('price', 'asc')->first()->price; 
            $margin = $h_price-$l_price;    $margin_div = (int) $margin/4;

            if ($h_price==$l_price) { 
                $price_array = array($l_price, $h_price);
            } else {
                $a = $l_price; $b = $a + $margin_div ; $c = $b + $margin_div; $d = $c + $margin_div; $e = $h_price;
                $price_array = array($a, $b, $c, $d, $e);
            }
        } else {  // no product found under category
                $price_array = null; 
        }

        // dd($price_array);

        return view('shop.shop_by_brands', compact('store_data', 'brand', 'price_array', 'products'));
    }


      // submit search query to appropriate route for handling;
      public function search_products(Request $request) {
          $query = $request['search_input'];  //  dd($request['search_input']);
          return redirect()->route('shop.shop_by_search', ['query'=>$query]);
      }


        //  handle search query, process and return serached results
        public function shop_by_search (Request $request, $query)
        {
            $store_data = $this->store_data;
            
            $order_criteria = 'prd_name';   $order_mode = 'asc';
            $products = Product::where('prd_name', 'LIKE', '%'.$query.'%')->orderBy($order_criteria, $order_mode)->simplePaginate(10); 
    
            if (count($products)>0) {  // product found under category
                $h_price = Product::where('prd_name', 'LIKE', '%'.$query.'%')->orderBy('price', 'desc')->first()->price; 
                $l_price = Product::where('prd_name', 'LIKE', '%'.$query.'%')->orderBy('price', 'asc')->first()->price; 
                $margin = $h_price-$l_price;    $margin_div = (int) $margin/4;
    
                if ($h_price==$l_price) { 
                    $price_array = array($l_price, $h_price);
                } else {
                    $a = $l_price; $b = $a + $margin_div ; $c = $b + $margin_div; $d = $c + $margin_div; $e = $h_price;
                    $price_array = array($a, $b, $c, $d, $e);
                }
            } else {  // no product found under category
                    $price_array = null; 
            }
    
            // dd($price_array);
    
            return view('shop.shop_by_search', compact('store_data', 'query', 'price_array', 'products'));
        }



    // fetch_catalog_ajax
    public function fetch_catalog_ajax (Request $request)
    {  DB::enableQueryLog();
        
       $ordering = $request['ordering'];     $fetch_id = $request['fetch_id'];     $fetch_mode = $request['fetch_mode'];  
       $order_criteria = '';                 $order_mode = '';         $price_ranges  = $request['price_ranges'];
       // dd("$fetch_mode - $fetch_id");

       if ($ordering=='prd_name_asc') {
           $order_criteria = 'prd_name'; $order_mode = 'asc';
       } else if ($ordering=='prd_name_desc') {
           $order_criteria = 'prd_name'; $order_mode = 'desc';
       } else if ($ordering=='prd_price_asc') {
           $order_criteria = 'price'; $order_mode = 'asc';
       } else if ($ordering=='prd_price_desc') {
           $order_criteria = 'price'; $order_mode = 'desc';
       }
       // dd($id);

       if ($fetch_mode=='prd_name') {  // if user is searching for a product name
        if (count($price_ranges)==4) {
            // 'prd_name', 'LIKE', '%'.$query.'%' 
            $products = Product::where($fetch_mode, 'LIKE', '%'.$fetch_id.'%')
                        ->where(function($query) use ($price_ranges) {  
    
                        $price_range1 = $price_ranges[0];   $price_range2 = $price_ranges[1];   $price_range3 = $price_ranges[2];     $price_range4 = $price_ranges[3];
                        $a = explode(':', $price_range1)[0];   $b = explode(':', $price_range1)[1];  $c = explode(':', $price_range2)[1];  $d = explode(':', $price_range3)[1]; $e = explode(':', $price_range4)[1];
    
                           $query->WhereBetween('price', [$a, $b]) 
                                 ->orWhereBetween('price', [$b, $c]) 
                                 ->orWhereBetween('price', [$c, $d]) 
                                 ->orWhereBetween('price', [$d, $e]);
                        })
                         ->orderBy($order_criteria, $order_mode)->simplePaginate(10); 
           
           } else if (count($price_ranges)==3) {
    
            $products = Product::where($fetch_mode, 'LIKE', '%'.$fetch_id.'%')
                        ->where(function($query) use ($price_ranges) {  
    
                        $price_range1 = $price_ranges[0];   $price_range2 = $price_ranges[1];   $price_range3 = $price_ranges[2];   
                        $a = explode(':', $price_range1)[0];   $b = explode(':', $price_range1)[1];  $c = explode(':', $price_range2)[1];  $d = explode(':', $price_range3)[1]; 
    
                           $query->WhereBetween('price', [$a, $b]) 
                                 ->orWhereBetween('price', [$b, $c]) 
                                 ->orWhereBetween('price', [$c, $d]);
                        })
                         ->orderBy($order_criteria, $order_mode)->simplePaginate(10); 
    
           } else if (count($price_ranges)==2) {
    
            $products = Product::where($fetch_mode, 'LIKE', '%'.$fetch_id.'%')
                        ->where(function($query) use ($price_ranges) {  
    
                        $price_range1 = $price_ranges[0];   $price_range2 = $price_ranges[1];  
                        $a = explode(':', $price_range1)[0];   $b = explode(':', $price_range1)[1];  $c = explode(':', $price_range2)[1]; 
    
                           $query->WhereBetween('price', [$a, $b]) 
                                 ->orWhereBetween('price', [$b, $c]);
                        })
                         ->orderBy($order_criteria, $order_mode)->simplePaginate(10); 
    
           } else if (count($price_ranges)==1) {
    
            $products = Product::where($fetch_mode, 'LIKE', '%'.$fetch_id.'%')
                        ->where(function($query) use ($price_ranges) {  
    
                        $price_range1 = $price_ranges[0];  
                        $a = explode(':', $price_range1)[0];   $b = explode(':', $price_range1)[1];  
    
                           $query->WhereBetween('price', [$a, $b]);
                        })
                         ->orderBy($order_criteria, $order_mode)->simplePaginate(10); 
    
           }
       } else {  // when user not searching for a product name
        if (count($price_ranges)==4) {
    
            $products = Product::where($fetch_mode, $fetch_id)
                        ->where(function($query) use ($price_ranges) {  
    
                        $price_range1 = $price_ranges[0];   $price_range2 = $price_ranges[1];   $price_range3 = $price_ranges[2];     $price_range4 = $price_ranges[3];
                        $a = explode(':', $price_range1)[0];   $b = explode(':', $price_range1)[1];  $c = explode(':', $price_range2)[1];  $d = explode(':', $price_range3)[1]; $e = explode(':', $price_range4)[1];
    
                           $query->WhereBetween('price', [$a, $b]) 
                                 ->orWhereBetween('price', [$b, $c]) 
                                 ->orWhereBetween('price', [$c, $d]) 
                                 ->orWhereBetween('price', [$d, $e]);
                        })
                         ->orderBy($order_criteria, $order_mode)->simplePaginate(10); 
           
           } else if (count($price_ranges)==3) {
    
            $products = Product::where($fetch_mode, $fetch_id)
                        ->where(function($query) use ($price_ranges) {  
    
                        $price_range1 = $price_ranges[0];   $price_range2 = $price_ranges[1];   $price_range3 = $price_ranges[2];   
                        $a = explode(':', $price_range1)[0];   $b = explode(':', $price_range1)[1];  $c = explode(':', $price_range2)[1];  $d = explode(':', $price_range3)[1]; 
    
                           $query->WhereBetween('price', [$a, $b]) 
                                 ->orWhereBetween('price', [$b, $c]) 
                                 ->orWhereBetween('price', [$c, $d]);
                        })
                         ->orderBy($order_criteria, $order_mode)->simplePaginate(10); 
    
           } else if (count($price_ranges)==2) {
    
            $products = Product::where($fetch_mode, $fetch_id)
                        ->where(function($query) use ($price_ranges) {  
    
                        $price_range1 = $price_ranges[0];   $price_range2 = $price_ranges[1];  
                        $a = explode(':', $price_range1)[0];   $b = explode(':', $price_range1)[1];  $c = explode(':', $price_range2)[1]; 
    
                           $query->WhereBetween('price', [$a, $b]) 
                                 ->orWhereBetween('price', [$b, $c]);
                        })
                         ->orderBy($order_criteria, $order_mode)->simplePaginate(10); 
    
           } else if (count($price_ranges)==1) {
    
            $products = Product::where($fetch_mode, $fetch_id)
                        ->where(function($query) use ($price_ranges) {  
    
                        $price_range1 = $price_ranges[0];  
                        $a = explode(':', $price_range1)[0];   $b = explode(':', $price_range1)[1];  
    
                           $query->WhereBetween('price', [$a, $b]);
                        })
                         ->orderBy($order_criteria, $order_mode)->simplePaginate(10); 
    
           }
       }


      // dd(DB::getQueryLog());
       return view('shop.fetch_catalog_ajax', compact('products'));
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
