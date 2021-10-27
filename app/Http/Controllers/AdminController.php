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
       $this->middleware('is_super');
       parent::__construct(); 
    }



   // load up the page for super access controls
   public function index () {
    
        $app_sections = $this->app_sections;  
        $db_app_sections = App_section::all();   $permitted_sections = [];   // dd($user);
        foreach ($db_app_sections as $key => $value) {
            $permitted_sections[] = $value->section;
        }
        return view('admin.super', compact('app_sections','permitted_sections')); 
   } 



   // update app sections that should be allowed or dis-allowed
   public function update_app_permissions (Request $request)
   {   

       $action = $request['action'];    $section = $request['section'];

       if ($action=='add') {  
           $query_rs = App_section::updateOrCreate(
               ['section'=>$section, 'status'=>'active'],
               []
           ); $msg = 'section permitted successfully';
       } else { 
           $msg = 'permission revoked successfully on this section';
           $deleted_rows = App_section::where(['section'=>$section])->delete();
       } 

       return response()->json(['message'=>$msg, 'status'=>1]); 

   }


   // refresh div section where access to app sections are managed
   public function refresh_app_permissions_ajax_fetch (Request $request) {
     
        $app_sections = $this->app_sections;  
        $db_app_sections = App_section::all();   $permitted_sections = [];   // dd($user);
        foreach ($db_app_sections as $key => $value) {
            $permitted_sections[] = $value->section;
        }
        return view('admin.refresh_app_permissions_ajax_fetch', compact('app_sections','permitted_sections')); 
      
   }


 
}
