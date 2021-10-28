<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Facades\Auth; 
use App\Models\Brand;
use App\Models\Access_permission;   


class BrandController extends BaseController
{
    
     public $title = 'brand';


    public function __construct() {
       $this->middleware('auth');
       parent::__construct(); 

    }



    // loads up the page that lists out all brands
    public function index()
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
        return view('admin.brands')->with('brands',$brands);
    }

    
  
    // store new brands to db
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
            'brd_name' => ['required', 'string', 'max:100', 'unique:brands'],
            'abbr' => ['required', 'string', 'max:3', 'unique:brands'],
            'description' => ['required', 'string', 'max:1000'],    
            'position' => ['required', 'string', 'max:55']
        ]); 
    
        $brand = Brand::create([
            'brd_name' => $data['brd_name'],
            'abbr' => strtoupper($data['abbr']),
            'description' => $data['description'],  
            'position' => $data['position'],
            'status' => 'active'
        ]); 
    
        return redirect()->route('brand.index')->with('success', 'New brand ('.$data['brd_name'].') created successfully.');
       
    
    }

    
    // loads up a form for branch update
    public function update_brand_fetch (Request $request)     {  
        
        if (!in_array($this->title, parent::app_sections_only())) {    
            return redirect()->route('access_denied'); 
        }

        if (auth()->user()->usr_type=='usr_admin') {
            if (!in_array(__FUNCTION__, parent::middleware_except())) {
                return redirect()->route('access_denied'); 
            }  
        }  


        $brand_id = $request['brand_id'];
        $brand = Brand::where('id', $brand_id)->firstOrFail();
        return view('admin.brand_update_ajax_fetch', compact('brand'));
        
    }


 
    // loads up a form for brand deleting
    public function delete_brand_fetch (Request $request)     {  
        
        if (!in_array($this->title, parent::app_sections_only())) {    
            return redirect()->route('access_denied'); 
        }

        if (auth()->user()->usr_type=='usr_admin') {
            if (!in_array(__FUNCTION__, parent::middleware_except())) {
                return redirect()->route('access_denied'); 
            }  
        }  

        $brand_id = $request['brand_id'];
        $brand = Brand::where('id', $brand_id)->firstOrFail();
        return view('admin.brand_delete_ajax_fetch', compact('brand'));
        
    }




   // update brand data
    public function update(Request $request, $brand_id)
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
            'brd_name' => ['required', 'string', 'max:100', 'unique:brands,brd_name,'.$brand_id.',id'],
            'abbr' => ['required', 'string', 'max:3', 'unique:brands,abbr,'.$brand_id.',id'],
            'description' => ['required', 'string', 'max:1000'],    
            'position' => ['required', 'string', 'max:55']
        ]); 

         Brand::where('id', $brand_id)
         ->update([  
            'brd_name' => $data['brd_name'],
            'abbr' => strtoupper($data['abbr']),
            'description' => $data['description'],  
            'position' => $data['position']
        ]); 

        return redirect()->route('brand.index')->with('success', 'brand updated Successfully.');
      
    }

 
    
    // delete a brand from db
    public function destroy($brand_id)
    {
        if (!in_array($this->title, parent::app_sections_only())) {    
            return redirect()->route('access_denied'); 
        }

        if (auth()->user()->usr_type=='usr_admin') {
            if (!in_array(__FUNCTION__, parent::middleware_except())) {
                return redirect()->route('access_denied'); 
            }  
        }  

        $brand = Brand::where('id', $brand_id)->firstOrFail(); 
        $brand->delete();    

        $brands = Brand::all();
       return redirect()->route('brand.index', compact('brands'))->with('success', 'Brand deleted successfully');
       
    }
}
