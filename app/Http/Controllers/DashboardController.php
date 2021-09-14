<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 
use App\Models\Notification;  
use App\Models\User;  
use App\Models\Message;  


class DashboardController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');  
        parent::__construct();
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






    public function chat_board ($user_id=null)
    {
      $users = User::all();     // dd($user_id); 
      return view('chat_board', compact('users', 'user_id'));
    }   
    
    
    
    public function post_chat (Request $request)
    { // dd($request);   
      $receiver_id = $request['user_id'];         $message = $request['message'];
      $sender_id = auth()->user()->user_id;       $status = 'sent';
      $channel = auth()->user()->user_id.'_'.$receiver_id;   $timestamp = time();
      $response = ['status'=>'failed'];

      $message = Message::create ([
        'sender_id' => $sender_id,
        'receiver_id' => $receiver_id,
        'channel' => $channel,
        'message' => $message,
        'status' => $status, 
        'timestamp' => $timestamp 
     ]);   $response = ['status'=>'sent'];

     return response()->json($response); 
    } 


    public function fetch_chat (Request $request)
    { // dd($request); 
      $receiver_id = $request['user_id'];      $user_id = auth()->user()->user_id;  
      $channel1 = $user_id.'_'.$receiver_id;   $channel2 = $receiver_id.'_'.$user_id;
      $messages = Message::where('channel', $channel1)->orWhere('channel', $channel2)->paginate(50);   // dd($message);
      return view('chat_box_ajax_fetch', compact('messages'));
    }
    
    

 
}
