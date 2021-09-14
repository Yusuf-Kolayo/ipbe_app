<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Facades\Auth; 
use App\Models\Active_state;    
use App\Models\User; 



class BaseController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public $user_id = ;



    public function __construct()
    {   
        $this->middleware('auth');  // dd(Auth::user());

        // $active_state = Active_state::where('user_id', $user_id)->first();
        // if ($active_state) {
        //     DB::table('active_states')->where('user_id', $user_id)
        //     ->update([
        //         'timestamp' => time()
        //     ]); 
        // } else {
        //     $active_state = Active_state::create ([
        //         'user_id' => $user_id,
        //         'timestamp' => time()
        //     ]);
        // }

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */ 
    
 
}
