<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;   
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth; 
use App\Models\User;
use App\Models\Staffs;
use App\Models\Activity;
use App\Models\Access_permission;



class StaffController extends BaseController
{ 
    
    
    public $middleware_except;   public $title = 'staff';


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


   public function index () {

    $section = 'index';   // dd($this->middleware_except);  
    if (auth()->user()->usr_type=='usr_admin') {
        if (in_array($section, $this->middleware_except)) {

        $staffs = Staffs::all(); 
        return view('admin.staffs', compact('staffs')); 

        } else { return redirect()->route('access_denied'); }
        }  
   }
   

   public function show ($staff_id) {

    $section = 'show';   // dd($this->middleware_except);  
    if (auth()->user()->usr_type=='usr_admin') {
        if (in_array($section, $this->middleware_except)) {

        $app_sections = $this->app_sections; 
        $user = User::Where('user_id', $staff_id)->firstOrFail();  // dd($user);
        $user_permissions = Access_permission::Where('user_id', $staff_id)->get();  //dd($user_permissions);
        foreach ($user_permissions as $key => $permission) {
            $permitted_sections[] = $permission->title.'_'.$permission->section;
           // $permitted_sections[1] = $permission->title.'_'.$permission->section;
        }   //dd($permitted_sections);
        
        return view('admin.staff_profile', compact('user','app_sections','permitted_sections'));

       } else { return redirect()->route('access_denied'); }
       } 
    }


    public function create() {

    }



    public function store (Request $request) 
    {


        DB::transaction(function () {

            $data = request()->validate([
                'first_name' => ['required', 'string', 'max:55'],
                'last_name' => ['required', 'string', 'max:55'],
                'other_name' => ['nullable', 'string', 'max:55'],
                'phone' => ['required', 'string', 'max:55', 'unique:clients'],
                'email' => ['required', 'string', 'email', 'max:99', 'unique:users'],
                'address' => ['required', 'string', 'max:200'],
                'gender' => ['required', 'string'],
                'city' => ['required', 'string'],
                'state' => ['required', 'string'],
    
                'username' => ['required', 'string', 'max:55', 'unique:users'],
                'password' => ['required', 'string', 'min:6', 'same:confirm_password'],
                'confirm_password' => ['required', 'string', 'min:6']
            ]); 

        $sql = DB::select("show table status like 'users'");
        $next_id = 100 + $sql[0]->Auto_increment;   $usr_type = 'usr_staff';   $status = 'active';
        $staff_id = 'STF-'.$next_id;  $actor_id = auth()->user()->user_id;

      
            $staff_cr = Staffs::create([  
                'staff_id' => $staff_id, 
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'other_name' => $data['other_name'],
                'phone' => $data['phone'],
                'address' => $data['address'],
                'gender' => $data['gender'],
                'city' => $data['city'],
                'state' => $data['state'],
                'actor_id' => $actor_id
            ]);
    
            $user_cr = User::create ([
                'user_id' => $staff_id,
                'status' => $status,
                'username' => strtolower($data['username']),
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'usr_type' => $usr_type
            ]);
        
            // save user activity
            $type = 'new_staff_reg';
            $activity = '<b>'.ucfirst(auth()->user()->username).' ['.$actor_id.']</b> registered a new staff <b> '.strtolower($data['username']).' ['.$staff_id.']</b>';
            $activity_cr = Activity::create ([
                'user_id' => auth()->user()->user_id,
                'usr_type' => auth()->user()->usr_type,
                'type' => $type,
                'activity' => $activity
            ]);
 
        });


        return redirect()->route('staff.index')->with('success', 'New staff ('.$request['username'].') registered successfuly');
    }


    public function edit ($id) {
       
    }

 
    public function update (Request $request, $staff_id) 
    {  
        $section = 'update';   // dd($this->middleware_except);  
        if (auth()->user()->usr_type=='usr_admin') {
            if (in_array($section, $this->middleware_except)) {
         
        DB::transaction(function() use ($request, $staff_id) {

            $data = request()->validate([
                'first_name' => ['required', 'string', 'max:55'],
                'last_name' => ['required', 'string', 'max:55'],
                'other_name' => ['nullable', 'string', 'max:55'],
                'phone' => ['required', 'string', 'max:55', 'unique:staffs,phone,'. $staff_id . ',staff_id'],
                'email' => 'required|string|email|max:99|unique:users,email,'. $staff_id .',user_id', 
                'address' => ['required', 'string', 'max:200'],
                'gender' => ['required', 'string'],
                'city' => ['required', 'string'],
                'state' => ['required', 'string'], 
            ]);
            
            Staffs::where('staff_id', $staff_id)
            ->update([  
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'other_name' => $data['other_name'],
                'phone' => $data['phone'],
                'address' => $data['address'],
                'gender' => $data['gender'],
                'city' => $data['city'],
                'state' => $data['state'],
            ]); 

            User::where('user_id', $staff_id)
            ->update([  
            'email' => $data['email']
            ]); 
 
        });
        
        return redirect()->route('staff.show', ['staff'=>$staff_id])->with('success', 'Profile updated successfully.');
       
        } else { return redirect()->route('access_denied'); }
        } else { // if not admin

            DB::transaction(function() use ($request, $staff_id) {

                $data = request()->validate([
                    'first_name' => ['required', 'string', 'max:55'],
                    'last_name' => ['required', 'string', 'max:55'],
                    'other_name' => ['nullable', 'string', 'max:55'],
                    'phone' => ['required', 'string', 'max:55', 'unique:staffs,phone,'. $staff_id . ',staff_id'],
                    'email' => 'required|string|email|max:99|unique:users,email,'. $staff_id .',user_id', 
                    'address' => ['required', 'string', 'max:200'],
                    'gender' => ['required', 'string'],
                    'city' => ['required', 'string'],
                    'state' => ['required', 'string'], 
                ]);
                
                Staffs::where('staff_id', $staff_id)
                ->update([  
                    'first_name' => $data['first_name'],
                    'last_name' => $data['last_name'],
                    'other_name' => $data['other_name'],
                    'phone' => $data['phone'],
                    'address' => $data['address'],
                    'gender' => $data['gender'],
                    'city' => $data['city'],
                    'state' => $data['state'],
                ]); 
    
                User::where('user_id', $staff_id)
                ->update([  
                'email' => $data['email']
                ]); 
     
            });
            
            return redirect()->route('staff.show', ['staff'=>$staff_id])->with('success', 'Profile updated successfully.');


        }
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
        $user_permissions = Access_permission::Where('user_id', $staff_id)->get();  //dd($user_permissions);
        foreach ($user_permissions as $key => $permission) {
            $permitted_sections[] = $permission->title.'_'.$permission->section;
           // $permitted_sections[1] = $permission->title.'_'.$permission->section;
        }   //dd($permitted_sections);

        return view('admin.user_permissions_refresh_ajax_fetch', compact('staff_id','app_sections','permitted_sections')); 
        } else { return redirect()->route('access_denied'); }
        } 
    }



    public function destroy ($staff_id)
    { 
        $section = 'destroy';   // dd($this->middleware_except);  
        if (auth()->user()->usr_type=='usr_admin') {
            if (in_array($section, $this->middleware_except)) {

        $staffs = Staffs::where('staff_id', $staff_id)->firstOrFail(); 
        $staffs->delete();      
        return redirect()->route('staff.index')->with('success', 'Account and related records deleted successfully');
    
        } else { return redirect()->route('access_denied'); }
        }
    }







 
}
