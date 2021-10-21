<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Facades\Auth; 
use App\Models\Access_permission;  
use App\Models\Category;


class CategoryController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     
    public $middleware_except;   public $title = 'category';


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



    public function sub_cat_ajax_fetch(Request $request)
    {  

        $section = 'sub_cat_ajax_fetch';       // dd($this->middleware_except);  
        if (auth()->user()->usr_type=='usr_admin') {
            if (in_array($section, $this->middleware_except)) {

                $main_cat_id = $request['main_cat_id'];    $element = $request['element'];   // dd($request['cat_id']); 
                $main_cat_name = DB::table('categories')->where('id', $main_cat_id)->value('cat_name');
                $sub_categories = Category::where('parent_id', $main_cat_id)->get();
                return view('admin.sub_categories_ajax_fetch', compact('sub_categories','main_cat_name', 'element'));         

                } else {  return redirect()->route('access_denied');  }
        }   

    }


 
    

    public function store(Request $request)
    {

        $section = 'store';       // dd($this->middleware_except);  
        if (auth()->user()->usr_type=='usr_admin') {
            if (in_array($section, $this->middleware_except)) {

        $data = request()->validate([
            'cat_name' => ['required', 'string', 'max:100', 'unique:categories'],
            'abbr' => ['required', 'string', 'max:3', 'unique:categories'],
            'description' => ['required', 'string', 'max:1000'],
            'meta_title' => ['required', 'string', 'max:100'],  
            'meta_desc' => ['required', 'string', 'max:1000'],  
            'meta_keyword' => ['required', 'string', 'max:100'], 
            'parent_id' => ['required', 'string', 'max:55'],     
            'position' => ['required', 'string', 'max:55']
        ]); 
    
        $categories = Category::create([
            'cat_name' => $data['cat_name'],
            'abbr' => strtoupper($data['abbr']),
            'description' => $data['description'], 
            'meta_title' => $data['meta_title'],
            'meta_desc' => $data['meta_desc'],
            'meta_keyword' => $data['meta_keyword'],
            'parent_id' => $data['parent_id'],
            'position' => $data['position'],
            'status' => 'active'
        ]); 
    
        return redirect()->route('category.index')->with('success', 'New category ('.$data['cat_name'].') created successfully.');
      
        }  else { return redirect()->route('access_denied'); }
        }
    
    
    }

   
    



    public function trash($id)
    {
        $section = 'trash';       // dd($this->middleware_except);  
        if (auth()->user()->usr_type=='usr_admin') {
            if (in_array($section, $this->middleware_except)) {

        $category = Category::findOrFail($id);
        return view('admin.category_trash')->with('category',$category);

        } else { return redirect()->route('access_denied'); }
        }

    }

   
    





    public function update(Request $request, $id)
    {
        
        $section = 'update';       // dd($this->middleware_except);  
        if (auth()->user()->usr_type=='usr_admin') {
            if (in_array($section, $this->middleware_except)) {

        $data = request()->validate([
            'category_name' => ['required', 'string', 'max:55', 'unique:categories,category_name,'. $id . 'id'],
            'description' => ['required', 'string', 'max:100'],
            'state' => ['required', 'string', 'max:22'],
            'lga' => ['required', 'string', 'max:55']
        ]); 

         Category::where('id', $id)
         ->update([  
            'category_name' => $data['category_name'],
            'description' => $data['description'],
            'state' => $data['state'],
            'lga' => $data['lga']
        ]); 

        return redirect()->route('category.show', ['category'=>$id])->with('success', 'category updated Successfully.');
        } else { return redirect()->route('access_denied'); }
        }
    }

  
    


    public function destroy($id)
    {
        $section = 'destroy';       // dd($this->middleware_except);  
        if (auth()->user()->usr_type=='usr_admin') {
            if (in_array($section, $this->middleware_except)) {

            } else { return redirect()->route('access_denied'); }
        }
    }
}
