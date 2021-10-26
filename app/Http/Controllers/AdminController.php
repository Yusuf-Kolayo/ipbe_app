<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;   
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth; 
use App\Models\App_section; 



class AdminController extends BaseController
{ 
    
 
    public function __construct() {
       $this->middleware('auth');
     //  $this->middleware('super');
       parent::__construct(); 
    }


   public function index () {
    
        $app_sections = $this->app_sections;  
        $permitted_sections = App_section::all();  // dd($user);
        return view('admin.super', compact('app_sections','permitted_sections')); 
    
   } 




   public function update_user_permission (Request $request)
   {  
       $section = 'update_user_permission';   // dd($this->middleware_except);  
       if (auth()->user()->usr_type=='usr_admin') {
           if (in_array($section, $this->middleware_except)) {

       $action = $request['action'];    $staff_id = $request['staff_id'];
       $title = $request['title'];        $section = $request['section'];

       if ($action=='add') {
           $query_rs = Access_permission::updateOrCreate(
               ['user_id'=>$staff_id, 'title'=>$title, 'section'=>$section],
               []
           ); $msg = 'section permitted successfully for '.$staff_id;
       } else { $msg = 'permission revoked successfully on this section for '.$staff_id;
           $deleted_rows = Access_permission::where(['user_id'=>$staff_id, 'title'=>$title, 'section'=>$section])->delete();
       } 

       return response()->json(['message'=>$msg, 'status'=>1]);

       } else { return redirect()->route('access_denied'); }
       }  

   }



   public function refresh_permissions_ajax_fetch (Request $request) {
    
       $section = 'refresh_permissions_ajax_fetch';   // dd($this->middleware_except);  
       if (auth()->user()->usr_type=='usr_admin') {
           if (in_array($section, $this->middleware_except)) {

       $staff_id = $request['staff_id']; // dd($request['product_id']);  
       $app_sections = $this->app_sections;  
       $user_permissions = Access_permission::Where('user_id', $staff_id)->get();   $permitted_sections = [];  //dd($user_permissions);
       foreach ($user_permissions as $key => $permission) {
           $permitted_sections[] = $permission->title.'_'.$permission->section;
          // $permitted_sections[1] = $permission->title.'_'.$permission->section;
       }   //dd($permitted_sections);

       return view('admin.user_permissions_refresh_ajax_fetch', compact('staff_id','app_sections','permitted_sections')); 
       } else { return redirect()->route('access_denied'); }
       } 
   }


 
}
