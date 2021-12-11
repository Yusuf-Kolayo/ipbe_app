<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Facades\File; 
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth; 
use App\Models\Access_permission;  
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;


class ProductController extends BaseController
{
  
    
    
    public $title = 'product';


    public function __construct() {
       $this->middleware('auth');
       parent::__construct(); 
    }




    // public function index()
    // { 

        // if (!in_array($this->title, parent::app_sections_only())) {    
        //     return redirect()->route('access_denied'); 
        // }

        // if (auth()->user()->usr_type=='usr_admin') {
        //     if (!in_array(__FUNCTION__, parent::middleware_except())) {
        //         return redirect()->route('access_denied'); 
        //     }  
        // }   
 
        
     //     $products = Product::all();                                          
    //     $main_categories = Category::where('parent_id', 0)->get();  
    //     return view('admin.products', compact('products','main_categories')); 
    // }

 
    

    // store a new product
    public function store(Request $request)
    {
        if (!in_array($this->title, parent::app_sections_only())) {    
            return redirect()->route('access_denied'); 
        }

        if (auth()->user()->usr_type=='usr_admin') {
            if (!in_array(__FUNCTION__, parent::middleware_except())) {
                return redirect()->route('access_denied'); 
            }  
        }   

  
        
        $data = request()->validate([
            'img_name' => ['required', 'image'],
            'prd_name' => ['required', 'string', 'max:100'],
            'description' => ['required', 'string', 'max:1000'],
            'brand_id' => ['required', 'string', 'max:55'],
            'price' => ['required', 'string', 'max:55'],
            'main_category_id' => ['required', 'string', 'max:55'],
            'sub_category_id' => ['required', 'string', 'max:55']
        ]); 
    
    
        $brand_abbr = DB::table('brands')->where('id', $data['brand_id'])->value('abbr');
        $sub_cat_abbr = DB::table('categories')->where('id', $data['sub_category_id'])->value('abbr');
        $sql = DB::select("show table status like 'products'");
        $next_id = 100 + $sql[0]->Auto_increment;   
        $product_id = "$brand_abbr-$sub_cat_abbr-$next_id";
   
        
        $file = $request->file('img_name');      $w=1098; $h=717;
        $ogImage = Image::make($file)->resizeCanvas($w, $h, 'center', false, 'ffffff');
        $originalPath = 'app/public/uploads/products_img/';   $random_string = Str::random(20);  
        $filename = time().'-'. $random_string .'.'. $file->getClientOriginalExtension();
        $ogImage =  $ogImage->save(storage_path($originalPath.$filename));
 

        $products = Product::create([  
            'product_id' => $product_id,
            'prd_name' => $data['prd_name'],
            'description' => $data['description'], 
            'img_name' => $filename,
            'brand_id' => $data['brand_id'],
            'price' => $data['price'],
            'main_category_id' => $data['main_category_id'],
            'sub_category_id' => $data['sub_category_id']
        ]); 
        
        return redirect()->route('product.sub', ['sub_category_id'=>$data['sub_category_id']])->with('success', 'product updated Successfully.');
      
    
    }
 



    // show product catalog
    public function sub($sub_category_id)
    {   
        if (!in_array($this->title, parent::app_sections_only())) {    
            return redirect()->route('access_denied'); 
        }

        if (auth()->user()->usr_type=='usr_admin') {
            if (!in_array(__FUNCTION__, parent::middleware_except())) {
                return redirect()->route('access_denied'); 
            }  
        }   

   
        
        $brands = Brand::all();
        $main_categories = Category::where('parent_id', 0)->get();  
        $sub_category = Category::where('id', $sub_category_id)->firstOrFail();  
        $products = Product::where('sub_category_id', $sub_category_id)->simplePaginate(10);
 
        return view('admin.products_catalog', 
        compact('products','main_categories','brands','sub_category_id','sub_category'));
    }

    

        // fetch product by brand for catalog
        public function fetch_product_by_brand (Request $request)
        {   
            if (!in_array($this->title, parent::app_sections_only())) {    
                return redirect()->route('access_denied'); 
            }
    
            if (auth()->user()->usr_type=='usr_admin') {
                if (!in_array(__FUNCTION__, parent::middleware_except())) {
                    return redirect()->route('access_denied'); 
                }  
            }   
            $brand_id = (int) $request['brand_id'];     $cat_id = $request['cat_id'];  // dd($request['cat_id']);
            $products = ($brand_id==0) ? Product::where(['sub_category_id'=> $cat_id])->simplePaginate(10) : Product::where(['sub_category_id'=> $cat_id, 'brand_id'=>$brand_id])->simplePaginate(10);
            // dd($products->hasMore);
            return view('components.products_catalog_ajax_fetch', compact('products'));
        }

    

    
    // update a product in database
    public function update_product_ajax_fetch(Request $request)
    {  
        if (!in_array($this->title, parent::app_sections_only())) {    
            return redirect()->route('access_denied'); 
        }

        if (auth()->user()->usr_type=='usr_admin') {
            if (!in_array(__FUNCTION__, parent::middleware_except())) {
                return redirect()->route('access_denied'); 
            }  
        }   

      
        
        $brands = Brand::all();
        $main_categories = Category::where('parent_id', 0)->get(); 

        $product_id = $request['product_id']; // dd($request['product_id']); 
        $product = Product::where('product_id', $product_id)->firstOrFail();
        return view('admin.product_update_ajax_fetch', compact('product','brands','main_categories')); 

    }



    // show a product details
    public function show_details_ajax_fetch (Request $request)
    {  
        if (!in_array($this->title, parent::app_sections_only())) {    
            return redirect()->route('access_denied'); 
        }

        if (auth()->user()->usr_type=='usr_admin') {
            if (!in_array(__FUNCTION__, parent::middleware_except())) {
                return redirect()->route('access_denied'); 
            }  
        }   

     
        
        $product_id = $request['product_id']; 
        $product = Product::where('product_id', $product_id)->firstOrFail(); // dd($product); 
        return view('admin.product_details_ajax_fetch', compact('product')); 
    }





    // refresh a product div after update
    public function refresh_product_ajax_fetch(Request $request)
    {   
        if (!in_array($this->title, parent::app_sections_only())) {    
            return redirect()->route('access_denied'); 
        }

        if (auth()->user()->usr_type=='usr_admin') {
            if (!in_array(__FUNCTION__, parent::middleware_except())) {  
                return redirect()->route('access_denied'); 
            }   
        }       

    
        
        $product_id = $request['product_id']; // dd($request['product_id']);  
        $product = Product::where('product_id', $product_id)->firstOrFail();
        return view('admin.product_refresh_ajax_fetch', compact('product')); 
        
    }



    // loads up a product profile   
    public function show($product_id)
    {
        if (!in_array($this->title, parent::app_sections_only())) {    
            return redirect()->route('access_denied'); 
        }

        if (auth()->user()->usr_type=='usr_admin') {
            if (!in_array(__FUNCTION__, parent::middleware_except())) {
                return redirect()->route('access_denied'); 
            }  
        }   

 

        $product = Product::where('product_id', $product_id)->firstOrFail();
        return view('admin.product_profile')->with('product',$product);
    }


    
    

    // update a product data
    public function update(Request $request, $product_id)
    {
    
        if (!in_array($this->title, parent::app_sections_only())) {    
            return redirect()->route('access_denied'); 
        }

        if (auth()->user()->usr_type=='usr_admin') {
            if (!in_array(__FUNCTION__, parent::middleware_except())) {
                return redirect()->route('access_denied'); 
            }  
        }   


        
        $data = request()->validate([
            'img_name' => ['nullable', 'image'],
            'prd_name' => ['required', 'string', 'max:100'],
            'description' => ['required', 'string'],
            'brand_id' => ['required', 'string', 'max:55'],
            'price' => ['required', 'string', 'max:55'],
            'main_category_id' => ['required', 'string', 'max:55'],
            'sub_category_id' => ['required', 'string', 'max:55']
        ]); 

        // $product = Product::find($product_id); 
        $product = Product::where('product_id', $product_id)->firstOrFail(); // $created_at = $product->created_at;  dd($created_at);
        $previous_image = DB::table('products')->where('product_id', $product_id)->value('img_name');

        if ($product) {

            if ($request->hasFile('img_name')) {  

                $file = $request->file('img_name');    $w=1098; $h=717;
                $ogImage = Image::make($file)->resizeCanvas($w, $h, 'center', false, 'ffffff');
                $originalPath = 'app/public/uploads/products_img/';  $random_string = Str::random(20); 
                $filename = time().'-'. $random_string .'.'. $file->getClientOriginalExtension();
                $ogImage =  $ogImage->save(storage_path($originalPath.$filename));

                DB::table('products')->where('product_id', $product_id)
                ->update([
                    'prd_name' => $data['prd_name'], 
                    'description' => $data['description'],
                    'brand_id' => $data['brand_id'],
                    'price' => $data['price'],
                    'main_category_id' => $data['main_category_id'],
                    'sub_category_id' => $data['sub_category_id'],
                    'img_name' => $filename
                ]); 
              
            } else { 
                DB::table('products')->where('product_id', $product_id)
                ->update([
                    'prd_name' => $data['prd_name'], 
                    'description' => $data['description'],
                     'brand_id' => $data['brand_id'],
                     'price' => $data['price'],
                     'main_category_id' => $data['main_category_id'],
                     'sub_category_id' => $data['sub_category_id']
                ]); 
            }
    
            if ($request->hasFile('img_name')) {  
               unlink(public_path().'/storage/uploads/products_img/'.$previous_image);
            }
            
            return response()->json(['message'=>'Product ['.$product_id.'] updated successfully.','status'=>1]);
        
        } else {
            return response()->json(['message'=>'An error occurred','status'=>0]);
        }
        
    }

   
    
    // delete a product from database
    public function destroy($product_id)
    {

        if (!in_array($this->title, parent::app_sections_only())) {    
            return redirect()->route('access_denied'); 
        }

        if (auth()->user()->usr_type=='usr_admin') {
            if (!in_array(__FUNCTION__, parent::middleware_except())) {
                return redirect()->route('access_denied'); 
            }  
        }   

   
        
        $product = Product::where('product_id', $product_id)->firstOrFail();
        $product_img = $product->img_name;
    
        if ($product) {
        $deleted_rows = Product::where('product_id', $product_id)->delete();
        if ($deleted_rows>0) {
            unlink(public_path().'/storage/uploads/products_img/'.$product_img); 
        }
        return response()->json(['message'=>'Product ['.$product_id.'] deleted successfully.','status'=>1]);
        }  else {
        return response()->json(['message'=>'An error occurred, please try again','status'=>0]);
        } 
    }


}
