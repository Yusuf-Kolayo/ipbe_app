<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Facades\Auth; 
use App\Models\Brand;
use App\Models\Access_permission;   


class BrandController extends BaseController
{
    
    public $middleware_except;   public $title = 'brand';


    public function __construct() {
       $this->middleware('auth');
       parent::__construct();
       
       $this->middleware(function ($request, $next) {    
        $user_id= Auth::user()->user_id;   $usr_type = Auth::user()->usr_type;
        if ($usr_type=='usr_admin') { $permitted_sections = array(); // dd('here');
        
        $user_permissions = Access_permission::Where(['user_id'=>$user_id, 'title'=>$this->title])->get();  //dd($user_permissions);
        foreach ($user_permissions as $key => $permission) {
            $permitted_sections[]  = $permission->section; 
        }    

        // $permitted_sections = substr($permitted_sections,0,-1);
        $this->middleware_except = $permitted_sections;
     
        }
        
        return $next($request);
       });

    }



    public function index()
    { 

        $section = 'index';   // dd($this->middleware_except);  
        if (auth()->user()->usr_type=='usr_admin') {
            if (in_array($section, $this->middleware_except)) {

                $brands = Brand::all();
                return view('admin.brands')->with('brands',$brands);

                } else {  return redirect()->route('access_denied');  }
        }   
    }

    
  
    public function store(Request $request)
    { 
        $section = 'store';   // dd($this->middleware_except);  
        if (auth()->user()->usr_type=='usr_admin') {
            if (in_array($section, $this->middleware_except)) {

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
        } else {  return redirect()->route('access_denied'); }
        }
    
    
    }

    
    
    public function update_brand_fetch (Request $request)     {   
        $section = 'update_brand_fetch';   // dd($this->middleware_except);  
        if (auth()->user()->usr_type=='usr_admin') {
            if (in_array($section, $this->middleware_except)) {


         $brand_id = $request['brand_id'];
         $brand = Brand::where('id', $brand_id)->firstOrFail();
         return view('admin.brand_update_ajax_fetch', compact('brand'));

            } else {  return redirect()->route('access_denied'); }
        } 
        
    }




    public function delete_brand_fetch (Request $request)     {   
        $section = 'delete_brand_fetch';   // dd($this->middleware_except);  
        if (auth()->user()->usr_type=='usr_admin') {
            if (in_array($section, $this->middleware_except)) {


         $brand_id = $request['brand_id'];
         $brand = Brand::where('id', $brand_id)->firstOrFail();
         return view('admin.brand_delete_ajax_fetch', compact('brand'));

            } else {  return redirect()->route('access_denied'); }
        } 
        
    }



   

   
    public function update(Request $request, $brand_id)
    {
        $section = 'update';   // dd($this->middleware_except);  
        if (auth()->user()->usr_type=='usr_admin') {
            if (in_array($section, $this->middleware_except)) {
        
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
        } else {  return redirect()->route('access_denied'); }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($brand_id)
    {
        $section = 'destroy';   // dd($this->middleware_except);  
        if (auth()->user()->usr_type=='usr_admin') {
            if (in_array($section, $this->middleware_except)) {

                $brand = Brand::where('id', $brand_id)->firstOrFail(); 
                $brand->delete();    
        
                $brands = Brand::all();
               return redirect()->route('brand.index', compact('brands'))->with('success', 'Brand deleted successfully');

            } else {  return redirect()->route('access_denied'); }
        }
        //
    }
}
