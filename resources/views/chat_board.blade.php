@extends('layouts.main')

@section('content')
<style>
 .direct-chat-messages, .direct-chat-contacts { height:350px; }
 .cust {
 font-size: 13px; background-color: #e2e2e2; padding: 5px;
 color: #000; width: 85%; float: left; border-radius: 5px;
 }
 .tmcus{ font-size: .8em; float: right!important; }
 .comp {
 font-size: 13px; background-color: #bedaff;
 color: #000; padding: 5px; width: 85%;
 float: right; border-radius: 5px;
 }
 .con {
 display: block;  width: 100%; overflow-x: auto; 
 -webkit-overflow-scrolling: touch; -ms-overflow-style: -ms-autohiding-scrollbar;
 }
 
 .tmcomp { font-size: .8em; float: right!important; }
 .nk-chat-panel    {  background-color: rgb(249, 249, 249); }
 .dark-mode  .cust {  background: #141c26; color: #798bff;  }    .dark-mode .comp {  background: #798bff;   color: #000;  }
 #img_status { width: 9px; height: 9px; border-radius: 50%; }
 
 @media screen and (min-width: 0px) and (max-width: 400px) { 

 }
 
 @media screen and (min-width: 401px) and (max-width: 600px){
      
 }
 
 @media screen and (min-width: 601px) and (max-width: 1280px){
     
 }
 
 @media screen and (min-width: 1281px) and (max-width: 3000px){
   
 }
     </style>
  

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Chat Page</h1>
            </div>
            
          </div>
        </div><!-- /.container-fluid -->
      </section>
  
      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-4">
                <div class="card">
                  <div class="card-header p-3 px-3">
                    <h3 class="card-title"> <i class="fa fa-clock-o"></i> Recent Conversations  </h3> 
                  </div><!-- /.card-header -->
                  <div class="card-body">
                @foreach ($users as $user)
                  @php
                       if ($user->usr_type=='usr_admin'){ 
                            $fullname = $user->staff->agt_first_name.' '.$user->staff->agt_first_name;   
                        } elseif ($user->usr_type=='usr_agent') {
                            $fullname = $user->agent->agt_first_name.' '.$user->agent->agt_last_name;
                        }  elseif ($user->usr_type=='usr_client') {
                            $fullname = $user->client->first_name.' '.$user->client->last_name;
                        } 
                  @endphp
                <a href="{{route('chat_board', ['user_id'=>$user->user_id])}}" class="dropdown-item px-1">   
                    <!-- Message Start -->
                    <div class="media">
                      <img src="{{ asset('images/avatar_dummy.png') }}" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                      <div class="media-body">
                        <h3 class="dropdown-item-title">
                          {{$fullname}}  
                        </h3>
                        <p class="text-sm short_msg">Call me whenever you can...</p>
                        <p class="text-sm text-muted mb-0"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                      </div>
                    </div>
                    <!-- Message End -->
                  </a>
                  <div class="dropdown-divider"></div> 
                @endforeach

  
                  </div>
                </div>
                <!-- /.card -->
              </div>
            <!-- /.col -->
            <div class="col-md-8">
                <!-- DIRECT CHAT -->
<div class="card direct-chat direct-chat-primary">                  
<div class="card-header p-2 px-3"> 
  <h3 class="card-title"> <i class="fa fa-clock-o"></i> Active Conversations  </h3>
  <div class="card-tools">

    <button type="button" class="btn btn-tool" title="Contacts" data-widget="chat-pane-toggle">
      <i class="fas fa-comments"></i>
    </button>
  </div>
</div>
<!-- /.card-header -->
<div class="card-body">
  <!-- Conversations are loaded here -->
  @if ($user_id!='')
    <div class="direct-chat-messages" id="msg_body" style=""></div> 
  @else
    <div class="pt-4"> <img src="{{asset('images/chats.gif')}}" class="img img-fluid" alt=""> </div>
  @endif
  <!--/.direct-chat-messages-->

  <!-- Contacts are loaded here -->
  <div class="direct-chat-contacts">
    <ul class="contacts-list">
        
            @foreach ($users as $user)
            @php
                 if ($user->usr_type=='usr_admin'){ 
                      $fullname = $user->staff->agt_first_name.' '.$user->staff->agt_first_name;   
                  } elseif ($user->usr_type=='usr_agent') {
                      $fullname = $user->agent->agt_first_name.' '.$user->agent->agt_last_name;
                  }  elseif ($user->usr_type=='usr_client') {
                      $fullname = $user->client->first_name.' '.$user->client->last_name;
                  } 
            @endphp
                <!-- End Contact Item -->
                <li>
                    <a href="#">
                        <img class="contacts-list-img" src="{{asset('css/dist/img/user7-128x128.jpg') }}" alt="User Avatar">

                        <div class="contacts-list-info">
                        <span class="contacts-list-name">
                           {{$fullname}}
                            <small class="contacts-list-date float-right">2/23/2015</small>
                        </span>
                        <span class="contacts-list-msg">I will be waiting for...</span>
                        </div>
                        <!-- /.contacts-list-info -->
                    </a>
                    </li>
                    <!-- End Contact Item -->    
                    
          @endforeach

     
      </ul>
    <!-- /.contacts-list -->
  </div>
  <!-- /.direct-chat-pane -->
</div>
<!-- /.card-body -->
<div class="card-footer">
  @if ($user_id!='')
  <form action="#" method="post" id="form_msg">
    <div class="input-group">
      <input type="text" name="message" placeholder="Type Message ..." class="form-control" id="txt_msg">
      <input type="hidden" name="user_id" value="{{$user_id}}" id="user_id"> 
      <span class="input-group-append">
        <button type="submit" class="btn btn-primary" id="btn_send">Send</button>
      </span>
    </div>
  </form>
  @else
    <p class="text-center">. . .</p>
    <input type="hidden" name="user_id" value="" id="user_id"> 
  @endif

</div>
<!-- /.card-footer-->
</div>
<!--/.direct-chat -->
</div>
<!-- /.col -->
</div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </section>

 








      
<script>

    window.onload = (event) => {   
      var user_id = $('#user_id').val(); 
      if (user_id) {
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    const user_id = urlParams.get('user_id');     // console.warn('{{$user_id}}');
      
      
    function fetch_chat () { 
            // after page loading or refresh
      
            var data2send={"user_id":"{{$user_id}}"}; 
            $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $("meta[name=csrf-token]").attr('content') }  });
            $.ajax({
                url:"{{route('fetch_chat')}}",
                dataType:"text",
                method:"GET",
                data:data2send,
                success:function(resp) {
                    $('#msg_body').html(resp); 
                    var element = document.getElementById("msg_body");
                    element.scrollTop = element.scrollHeight; 
                    // document.querySelector('#msg_base').scrollIntoView({  behavior: 'smooth' });
                    // fetch_status()        // fetch_status
                }
            });
       } 
    fetch_chat ();
    
    
    
    $('#form_msg').on('submit', function(e){
        e.preventDefault();   
        $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $("meta[name=csrf-token]").attr('content') }  });
        $.ajax({
                type: 'POST',
                url: "{{route('post_chat')}}",
                data: new FormData(this),
                dataType: 'json',
                contentType: false,
                cache: false,
                processData:false,
                success: function(response){ //console.log(response); 
                    $("#txt_msg").val("")
                    if(response.status == 'sent'){
                      console.warn(response.message);    fetch_chat();    
                    } else {  console.warn(response.message);  }  
                }
            });  
    });
    
    
    // $("#msg").keyup(function(){
    //     var data2send={"acnumber":''};
    //     $.ajax({
    //             url:"customer_chat_status.php",
    //             dataType:"text",
    //             method:"POST",
    //             data:data2send,
    //             // success:function(resp){ 
    //             //     console.warn(response.message); 
    //             // }
    //         });
    // });
    
    
    
    function fetch_status () { 
            // after page loading or refresh
            var data2send={"acnumber":''};
            
            $.ajax({
                url:"customer_status_fetch.php",
                dataType:"text",
                method:"POST",
                data:data2send,
                success:function(resp){
                    $('.msg_status').html(resp); 
                }
            });
    }
    
    
    var intervalId = window.setInterval(function() {
     fetch_chat(); // fetch new chat data at 5 seconds interval
    }, 5000);

      }
    
    }
     
    </script>
    
 
 

@endsection
