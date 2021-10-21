<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; 
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Session;   
use Illuminate\Support\Facades\Hash; 
use App\Models\Access_permission;
use App\Models\Staffs;
use App\Models\User;


class DevController extends BaseController 
{

   public $pass_key = '999999';


    public function __construct()
    {
         
    }




    public function index()
    { 
        return view('dev.index');
    }

  




    public function register_an_admin (Request $request) 
    {  

        $data = request()->validate([
            'pass_key' => ['required', 'string'],
            'usr_type' => ['required', 'string']
        ]); 


        $pass_key = $request['pass_key']; 
        if ($pass_key==$this->pass_key) {

            DB::transaction(function ()  {

              $data = request()->validate([ 

                'pass_key' => ['required', 'string'],
                'usr_type' => ['required', 'string'],

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
        $next_id = 100 + $sql[0]->Auto_increment;  $status = 'active';
        $staff_id = 'STF-'.$next_id;  $actor_id = 0;

      
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
                'usr_type' => $data['usr_type']
            ]);
        
         

        });
         

        return redirect()->route('dev')->with('success', 'New staff ('.$request['username'].') registered successfuly');
       } else {  return redirect()->route('dev')->with('error', 'Operation un-authorized, Invalid passkey.');  }

    } 
    





    public function update_all_permission (Request $request) {
         $pass_key = $request['pass_key'];   $user_id = $request['user_id'];
         $staff = Staffs::where('staff_id', $user_id)->firstOrFail();
         if ($pass_key==$this->pass_key) {
            $deleted_rows = Access_permission::where('user_id', $user_id)->delete();
            $app_sections = $this->app_sections; 
            foreach ($app_sections as $key => $app_section) {
                foreach ($app_section[1] as $section) {
                    $user = Access_permission::create ([
                        'user_id' =>  $user_id,
                        'title' => $app_section[0],
                        'section' => $section[0]
                    ]);
                }
            }

           return redirect()->route('dev')->with('success', 'All Permissions granted');
        
         } else { 
            return redirect()->route('dev')->with('error', 'Invalid Passkey');
         }
    }
 
}
