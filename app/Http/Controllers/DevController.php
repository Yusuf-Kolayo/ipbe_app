<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; 
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Session;  
use App\Models\Access_permission;
use App\Models\Staffs;


class DevController extends BaseController 
{

    public function __construct()
    {
         
    }




    public function index()
    { 
        return view('dev.index');
    }

 


    public function update_app_sections ()
    { 
        $app_sections = $this->app_sections; 
        foreach ($app_sections as $key => $value) {
            dd($value);
        }
    }




    public function update_all_permission (Request $request) {
         $pass_key = $request['pass_key'];   $user_id = $request['user_id'];
         $staff = Staffs::where('staff_id', $user_id)->firstOrFail();
         if ($pass_key=='999') {
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
