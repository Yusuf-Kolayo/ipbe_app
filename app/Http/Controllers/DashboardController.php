<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 
use App\Models\Notification;  


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



    public function resolve_notification($notification_id)
    {
        $notification = Notification::findOrFail($notification_id);
        if ($notification->type=='new_purchase_reg') {
            $client_id = $notification->main_foreign_key; 

            $affected1 = DB::table('notifications')
            ->where('id', $notification_id)
            ->update([ 'status' => 'seen' ]); 

            return redirect()->route('client.show', ['client'=>$client_id])->with('success', 'switch to the <i>purchase sessions tab</i> to see new product purchases for this client');
        } elseif ($notification->type=='purchase_session_approved') {
            $client_id = $notification->main_foreign_key; 

            $affected1 = DB::table('notifications')
            ->where('id', $notification_id)
            ->update([ 'status' => 'seen' ]); 

            return redirect()->route('client.show', ['client'=>$client_id])->with('success', 'switch to the <i>purchase sessions tab</i> to see new product purchases for this client');
        }
    }






    public function all_notifications ()
    {
       return view('components.notifications');
    }





    
    public function my_profile ()
    {
       if (auth()->user()->usr_type=='usr_admin') {
          return redirect()->route('admin.profile', ['admin'=>auth()->user()->username]);
       } elseif (auth()->user()->usr_type=='usr_agent') {
          return redirect()->route('agent.show', ['agent'=>auth()->user()->username]);
       } elseif (auth()->user()->usr_type=='usr_client') {
          return redirect()->route('client.show', ['client'=>auth()->user()->user_id]);
       }
    }






    public function chat_board ()
    {
      return view('chat_board');
    }
}
