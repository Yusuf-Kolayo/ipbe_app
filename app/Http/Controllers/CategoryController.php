<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Facades\Auth; 
use App\Models\Access_permission;  
use App\Models\Category;
use App\Models\Brand;


class CategoryController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     
     public $title = 'category';


    public function __construct() {
       $this->middleware('auth');
       parent::__construct(); 

    }


    // loads up the category default page listing out available categories
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

        $main_categories = Category::where('parent_id', 0)->get(); 
        return view('admin.categories')->with('main_categories',$main_categories);  
    }



    // fetch out sub-categories under a main-category
    public function sub_cat_ajax_fetch(Request $request)
    {  

        if (!in_array($this->title, parent::app_sections_only())) {    
            return redirect()->route('access_denied'); 
        }

        if (auth()->user()->usr_type=='usr_admin') {
            if (!in_array(__FUNCTION__, parent::middleware_except())) {
                return redirect()->route('access_denied'); 
            }  
        }  


        $main_cat_id = $request['main_cat_id'];    $element = $request['element'];   // dd($request['cat_id']); 
        $main_cat_name = DB::table('categories')->where('id', $main_cat_id)->value('cat_name');
        $sub_categories = Category::where('parent_id', $main_cat_id)->get();
        return view('admin.sub_categories_ajax_fetch', compact('sub_categories','main_cat_name', 'element'));         


    }


 
    

    // store a new category
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

    }




    // fetch through ajax: a form to update category
    public function edit_category_ajax_fetch (Request $request)
    {
        if (!in_array($this->title, parent::app_sections_only())) {    
            return redirect()->route('access_denied'); 
        }

        if (auth()->user()->usr_type=='usr_admin') {
            if (!in_array(__FUNCTION__, parent::middleware_except())) {
                return redirect()->route('access_denied'); 
            }  
        }   

        $category_id = $request['cat_id'];

        $category = Category::findOrFail($category_id);  //dd($category);
        $main_categories = Category::where('parent_id', 0)->get(); 
        return view('admin.category_edit_ajax_fetch', compact('category','main_categories'));

    }




        // fetch through ajax: a form to delete category
        public function delete_category_ajax_fetch (Request $request)
        {
            if (!in_array($this->title, parent::app_sections_only())) {    
                return redirect()->route('access_denied'); 
            }
        
            if (auth()->user()->usr_type=='usr_admin') {
                if (!in_array(__FUNCTION__, parent::middleware_except())) {
                    return redirect()->route('access_denied'); 
                }
            }   
    
            $category_id = $request['cat_id'];
    
            $category = Category::findOrFail($category_id);  //dd($category);
            return view('admin.category_delete_ajax_fetch', compact('category'));
    
        }


   
     

    // update a category data
    public function update(Request $request, $id)
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
            'cat_name' => ['required', 'string', 'max:55', 'unique:categories,cat_name,'. $id . 'id'], 
            'abbr' => ['required', 'string', 'max:3', 'unique:categories,abbr,'. $id . 'id'],
            'description' => ['required', 'string', 'max:1000'],
            'meta_title' => ['required', 'string', 'max:100'],  
            'meta_desc' => ['required', 'string', 'max:1000'],  
            'meta_keyword' => ['required', 'string', 'max:100'], 
            'parent_id' => ['required', 'string', 'max:55'],
            'position' => ['required', 'string', 'max:55']

        ]); 

         Category::where('id', $id)
         ->update([  
            'cat_name' => $data['cat_name'],
            'abbr' => strtoupper($data['abbr']),
            'description' => $data['description'], 
            'meta_title' => $data['meta_title'],
            'meta_desc' => $data['meta_desc'],
            'meta_keyword' => $data['meta_keyword'],
            'parent_id' => $data['parent_id'],
            'position' => $data['position']
        ]); 

        return redirect()->route('category.index')->with('success', 'category updated successfully');
      
    }

  
    


    // destroy a category from db
    public function destroy($id)
    {
        if (!in_array($this->title, parent::app_sections_only())) {    
            return redirect()->route('access_denied'); 
        }

        if (auth()->user()->usr_type=='usr_admin') {
            if (!in_array(__FUNCTION__, parent::middleware_except())) {
                return redirect()->route('access_denied'); 
            }  
        }   

        $category = Category::where('id', $id)->firstOrFail(); 
        if ($category) {
            $deleted_rows = Category::where('id', $id)->delete();
        }   


        return redirect()->route('category.index')->with('success', 'category updated successfully');        
    }


}
