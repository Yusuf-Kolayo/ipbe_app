<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 
use App\Models\Notification;  
use App\Models\User;  
use App\Models\Message;  
use App\Models\Active_state;  


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

            return redirect()->route('client.show', ['client'=>$client_id])->with('success', 'switch to the <i>purchase sessions tab<\/i> to see new product purchases for this client');
        } elseif ($notification->type=='purchase_session_approved') {
            $client_id = $notification->main_foreign_key; 

            $affected1 = DB::table('notifications')
            ->where('id', $notification_id)
            ->update([ 'status' => 'seen' ]); 

            return redirect()->route('client.show', ['client'=>$client_id])->with('success', 'switch to the <i>purchase sessions tab<\/i> to see new product purchases for this client');
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






    public function chat_board ($receiver_id=null)
    { 
      $chat_patner = User::where('user_id', $receiver_id)->first();     $curr_user_id = auth()->user()->user_id;       $chat_patners = array();
      $chat_patner_ids = array_unique(json_decode(Message::where('sender_id', $curr_user_id)->pluck('receiver_id')));   //  dd($chat_patner_ids); 
      foreach ($chat_patner_ids as $key => $chat_patner_id) {
         $user_info = User::where('user_id', $chat_patner_id)->first(); 

         $channel1 = $curr_user_id.'_'.$chat_patner_id;   $channel2 = $chat_patner_id.'_'.$curr_user_id;
         $last_msg_rows = Message::where('channel', $channel1)->orWhere('channel', $channel2)->get()->last();  // dd($last_msg_rows);
         
         $chat_patners[] = [$user_info, $last_msg_rows];
      } 
      return view('chat_board', compact('chat_patner', 'chat_patners'));
    }   
    
    
    
    public function post_chat (Request $request)
    { // dd($request);   
      $receiver_id = $request['patner_id'];         $message = $request['message'];
      $sender_id = auth()->user()->user_id;       $status  = 'sent';
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
      $receiver_id = $request['patner_id'];      $user_id = auth()->user()->user_id;     // dd($receiver_id);
      $channel1 = $user_id.'_'.$receiver_id;   $channel2 = $receiver_id.'_'.$user_id;
      $messages = Message::where('channel', $channel1)->orWhere('channel', $channel2)->paginate(50);    
      $timestamp = Active_state::where('user_id', $receiver_id)->value('timestamp'); 
      $patner_username = User::where('user_id', $receiver_id)->value('username'); 
      $active_time =  parent::get_time($timestamp, $patner_username);   // dd($time);

      $chatboard_msg = '<div class="d-block">';

      foreach ($messages->sortKeys() as $message) {
       if($message) {
       
          if ($message['status']=='sent') {  $eye = '<i class="ion-android-done"><\/i >';  } 
                                      else {  $eye = '<i class="ion-android-done-all"><\/i >';  } 
         
          if (auth()->user()->user_id==$message['sender_id'])    {
          $chatboard_msg .= '<p class="comp mb-1">'.$message['message'].'<span class="tmcomp"> <b style="font-size:12px">'.$eye.' you:<\/b> <br>'.$message['created_at'].'<\/span > <\/p >';  
          } else {
          $chatboard_msg .= '<p class="cust mb-1">'.$message['message'].'<span class="tmcus"> <b style="font-size:12px"><span class="ion-ios-contact-outline"><\/span > '.$message->sender->username.'<\/b ><br >'.$message['created_at'].'<\/span> <\/p >';
         
          DB::table('messages')->where('id', $message['id'])->update(['status' => 'seen']);  
              }
           }
       }
      $chatboard_msg .= '<\/div >
      <p class="d-block text-center mt-2 mb-0" id="msg_base">...<\/p >';


    // NOW LETS FETCH CONVERSATIONS

    $curr_user_id = auth()->user()->user_id;       $chat_patners = array();
    $chat_patner_ids = array_unique(json_decode(Message::where(['receiver_id'=> $curr_user_id, 'status'=>'sent'])->pluck('sender_id')));   //  dd($chat_patner_ids); 
    foreach ($chat_patner_ids as $key => $chat_patner_id) {
        $user_info = User::where('user_id', $chat_patner_id)->first(); 

        $channel1 = $curr_user_id.'_'.$chat_patner_id;   $channel2 = $chat_patner_id.'_'.$curr_user_id;
        $last_msg_rows = Message::where('channel', $channel1)->orWhere('channel', $channel2)->get()->last();  // dd($last_msg_rows);
        
        $chat_patners[] = [$user_info, $last_msg_rows];
    }  
 

    $topnav_msg = '
    <a class="nav-link" data-toggle="dropdown" href="#">
      <i class="far fa-comments"><\/i>';

      if (count($chat_patners)>0) {
          $topnav_msg .= '<span class="badge badge-danger navbar-badge">'.count($chat_patners).'</span>';
      } 
      $topnav_msg .= '</a>
      <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right"> ';
       

      foreach ($chat_patners as $user) {
                  // dd($user);
                  // if ($user[0]->usr_type=='usr_admin') { 
                  //     $fullname = $user[0]->staff->agt_first_name.' '.$user[0]->staff->agt_first_name;   
                  // } elseif ($user[0]->usr_type=='usr_agent') {
                  //     $fullname = $user[0]->agent->agt_first_name.' '.$user[0]->agent->agt_last_name;
                  // }  elseif ($user[0]->usr_type=='usr_client') {
                  //     $fullname = $user[0]->client->first_name.' '.$user[0]->client->last_name;
                  // } 
            
          $topnav_msg .= '
          <a href="'.route('chat_board', ['user_id'=>$user[0]->user_id]).'" class="dropdown-item px-1">    
              <div class="media">
                <img src="'.asset('images/avatar_dummy.png').'" alt="User Avatar" class="img-size-50 ml-1 mr-2 img-circle">
                <div class="media-body">
                  <h3 class="dropdown-item-title">'.$user[0]->username.'<\/h3>';

                    if ($user[1]) {
                    $topnav_msg .= '
                    <p class="text-sm short_msg">'.substr($user[1]->message,0,30).' ...<\/p>
                    <p class="text-sm text-muted mb-0"><i class="far fa-clock mr-1"><\/i>'.$user[1]->created_at.'<\/p>';
                    } else { $topnav_msg .= '<p class="text-sm short_msg">---<\/p>'; }

                $topnav_msg .= '
              <\/div>
            <\/div>
          <\/a>
          <div class="dropdown-divider"><\/div>';
      }

 
        $topnav_msg .= '
      <a href="'.route('chat_board', ['chat_patner'=>[]]).'" class="dropdown-item dropdown-footer">See All Messages<\/a>
    <\/div>';

   // dd($topnav_msg);



      return response()->json(['chatboard_msg'=>$chatboard_msg, 'topnav_msg'=>$topnav_msg, 'active_time'=>$active_time]);
     // return view('chat_box_ajax_fetch', compact('messages'));
    }
    
    

 
}
