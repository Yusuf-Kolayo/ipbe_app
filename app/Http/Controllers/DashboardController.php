<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    
    public function index()
    {
        $curr_user = auth()->user();  // get user data
        if ($curr_user->usr_type=='usr_admin')       { $view = 'admin.dashboard'; } 
        else if ($curr_user->usr_type=='usr_agent')  { $view='agent.dashboard';   }
        else if ($curr_user->usr_type=='usr_client') { $view='client.dashboard';  }
    
        return view($view,   [  'curr_user'=>$curr_user  ]);  
    }
}
