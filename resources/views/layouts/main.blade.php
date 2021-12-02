<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1"> 

      <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', "DAP_SOFTWARE") }}</title>


  <!-- Fonts -->
  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  
  
<link rel="shortcut icon" href="{{asset('global_assets/images/fav.png') }}">
<link rel="stylesheet" href="{{asset('assets/css/dashlite.css?ver=2.2.0')}}">
<link id="skin-default" rel="stylesheet" href="{{asset('assets/css/theme.css?ver=2.2.0')}}">
<!-- fontawesome icons -->
<link rel="stylesheet" href="{{ asset('icons/css/all.min.css') }}">

 



<style>
.loader {
border: 16px solid #f3f3f3;
border-radius: 50%;
border-top: 16px solid blue;
border-bottom: 16px solid blue;
width: 120px;
height: 120px;
-webkit-animation: spin 2s linear infinite;
animation: spin 2s linear infinite;
}
.badge { display: inline-block;  padding : 0.15rem;    font-size: 0.6rem;      font-weight: 500; line-height: 1;  text-align: center;   white-space: nowrap;    vertical-align: baseline;     border-radius: 50%; transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out; }
.btn-sd {  width: 100%;  text-align: center;  display: block;  }
.cpic {   width: 37px;   border-radius: 50%;   border: 2px solid #798bff;   margin-right: 6px; }
.cpic_h {  width: 44px; border-radius: 50%;  border: 2px solid #798bff;  }
.dropdown-head  {  padding: 0.25rem 0.25rem;  }
.pnote { color: #798bff; }
.mssg {  font-size: 13px; font-weight: 600; color: #636667; }
.media_ch {  border-bottom: 1px solid rgb(22 173 241 / 27%);  margin-bottom: 5px; margin-top: 11px;  }
.mtm {  float: right;  font-size: 10px;  font-style: italic; }
.con-ovf { display: block;  width: 100%;   overflow-x: auto;  -webkit-overflow-scrolling: touch;  -ms-overflow-style: -ms-autohiding-scrollbar; }
.modal-header {  padding: 1rem 1.5rem; background-color: #e7eaec; }
.form-control:focus {  box-shadow: 0 0 0 3px rgba(101, 118, 255, 0); }
.logo-img {  width: 195px;  margin: 0 auto;  }
.dark-mode .modal-header {  background-color: #2f4258;  }
.dark-mode .mssg { color: #b8d5fd; }
.modal-header { display: block; }
.user_avatar { background-color: #798bff; padding: 11px; border-radius: 50%; margin: 4px; color: #fff; }
#spotlight .scene img {  background-color: #fff; }  
.nk-menu-item         { text-align: left; }
.alert.alert-icon     {    padding-left: 1.25rem; }
.prd_lbl { float: right;  background-color: #8895fd; padding-left: 11px; padding-right: 11px; color: #fff; border-radius: 12%;  font-size: 13px; } 
.prd_lbl2 { color: #6c75bb; float: right;  padding-left: 11px; padding-right: 11px;   font-size: 13px;  font-weight: 600; /* background-color: #fff; border: 2px solid #6c75bb;  border-radius: 12%; */ } 
.active_x { color: #6576ff!important; } .h_card { height:433px;  } .bg_dim_red { background-color:#ffeaea;}
.nk-sidebar .nk-menu > li .nk-menu-sub .nk-menu-sub {  margin-left: 50px;  }
.hover_bg_none:hover { background: none!important; }
div.card-header .card-title {  color: #364a63!important;  font-size: 20px; }
td, th { font-size: 13px!important; } label { font-weight: 400!important;  margin-bottom: 0px;   margin-top: 13px; }
.modal-dialog form, .modal-dialog div.text-center  { margin: 0 auto;  width: 100%; }
div.dataTables_wrapper div.dataTables_filter label { margin-top: 0px ; }
.alert.alert-icon > .icon { position: initial; }  
._select {margin: 0px ; padding: 5px ; padding-left: 10px ;  width: 100%; border: 1px solid; border-radius: 5px ; }
div>h6>a { text-transform: capitalize; } .preloader1 { width: 10%; }
.frame { width: 100%; height: 100%; overflow: hidden; }
.zoomin img { width: 100%; height: 100% -webkit-transition: all 0.5s ease; -moz-transition: all 0.5s ease; -ms-transition: all 0.5s ease; transition: all 0.5s ease; }
.zoomin img:hover { -moz-transform: scale(1.1); -webkit-transform: scale(1.1); transform: scale(1.1); }
</style>




 
<style> 
label { font-weight: 400!important; } .img-size-50 { width: 38px; }
.table td, .table th { padding: .25rem; font-size: 14px;}
#example1_filter { text-align: right;  font-size: 13px; }
#example1_filter input {  height: calc(1.5125rem + 2px); } 
.buttons-html5, .buttons-print { font-size: 13px;  padding-top: 3px;  padding-bottom: 3px;   padding-left: 10px;  padding-right: 10px;  margin: 2px; }
.page-link { padding: .3rem .55rem;  font-size: 12px; }
#example1_wrapper { display: block;  width: 100%;   overflow-x: auto;  -webkit-overflow-scrolling: touch; }
.profile-user-img { border: 3px solid #2196f3;    border-radius:50%;   margin: 0 auto;   padding: 4%;     color: #2196f3; width: 100px;   background: #f1fbff;  font-family: monospace;   font-size: 30px; display: block; }
.box_sh {border-radius: 5px;   box-shadow: 0px 0px 14px 0px #bebebe, -20px -20px 60px #ffffff;    margin-bottom: 25px; }
th {  white-space: nowrap; }
.th_span {  white-space: nowrap; } 
.btn-app { height: 32px; padding: 6px 9px; margin: 0 10px 10px 0px; border-radius: 3px;  border: 1px solid #ddd; color: #6c757d; font-size: 12px;}
.alert-danger { color: #e91e63;   background-color: #fff0f1;  border-color: #d32535; }
.alert-success {  color: #014880;   background-color: #e0edf9;  border-color: #014880; }
.list-group-item { border-bottom: 1px solid rgba(0,0,0,.125);  }
.th_head { background-color: #f3f3f3; }
th.th_head_sm { font-weight: 600;  font-size: 13px; }
.table td, .table th {  border-TOP: 0px;  border-bottom: 1px solid #dee2e6; }
a.btn { white-space: nowrap; }   button.btn { white-space: nowrap; }
.nav-treeview .nav-item {  padding-left: 14px; }
.nav-pills .nav-link.active, .nav-pills .show>.nav-link { font-size: 14px; }
.fade_hd_red { background-color: #fdcece; }
.fade_bd_red { background-color: #fff0f0; } 

.fade_hd_green { background-color: #d7ffd7; }
.fade_bd_green { background-color: #f0fff0; }

.fade_hd_blue { background-color: #d7e9ff; }
.fade_bd_blue { background-color: #f0f4ff; }
.card-body { padding: .5rem; }
.note_each { font-size: 14px; white-space: inherit; display: inline-block; }
.short_msg { white-space: break-spaces; margin-bottom: 2px; }

  @media (min-width: 576px) {
    .large_modal  { max-width:90%!important; } 
    .medium_modal { max-width:70%!important; }
  }
  </style>

  @yield('headers')

</head>





@php
//  FETCH MAIN CATEGORIES HERE DUE TO COMMON INTEREST AMONG THE USER TYPES
 $main_categories = App\Models\Category::where('parent_id', 0)->get();

 // fetch newly sent notifications belonging to current user
 $new_notifications = App\Models\Notification::where('receiver_id', auth()->user()->user_id)->latest()
 ->where('status', 'sent')->get();

 $notification_icon_array = array( 
   'new_purchase_reg' => 'fas fa-shopping-cart',
   'purchase_session_approved' => 'fas fa-legal',
   'new_target_request'=>'fas fa-piggy-bank',
   'new_client_reg'=> 'fas fa-user'
);
 @endphp





<body class="nk-body bg-lighter npc-general has-sidebar dark-mode">
    <div class="nk-app-root">

        
    <div class="nk-main ">
        


            <!-- Decide Appropriate Navbars -->
            @admin
               @include('components.admin_sidebar') 
            @endadmin 
        
          
            @agent
                @include('components.agent_sidebar') 
            @endagent   
          
         
            @client
                @include('components.client_sidebar') 
            @endclient  

             

    <div class="nk-wrap ">
    
    <!-- top nav -->
    @include('components.top_nav')


       



                <!-- main header  -->
                <!-- content      -->
                <div class="nk-content ">
                    <div class="">
                        <div class="nk-content-inner">
                            <div class="nk-content-body">

                            
                                <div class="container-fluid pb-2">
                                    <x-alerts /> 
                                </div>
                                 
                                @yield('content') 
                            

                            </div>
                        </div>
                    </div>
                </div>


 


  <!-- /.content-wrapper -->
  @include('components.footer')




  
  @yield('page_scripts') 

   @if (auth()->user())
        <script>
         $(document).ready(function() { 
        //  $(window).load(function() { 

            var patner_id = $('#patner_id').val(); 
        
            function fetch_chat () { 
                // after page loading or refresh
                if ($('#msg_body').length > 0) { var data2send={"patner_id":patner_id};  }
                                        else { var data2send={"patner_id":""};   }
                $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $("meta[name=csrf-token]").attr('content') }  });
                $.ajax({
                    url:"{{route('fetch_chat')}}",
                    dataType:"text",
                    method:"POST",
                    data:data2send,
                    success:function(resp) { 
                    if ($('#msg_body').length > 0) {  
                        $('#msg_body').html(JSON.parse(resp).chatboard_msg.replace(/\\/g, ""));    // console.warn(JSON.parse(resp).active_time);
                        $('#active_time').html(JSON.parse(resp).active_time.replace(/\\/g, ""));  

                         var element = document.getElementById("msg_body");
                         element.scrollTop = element.scrollHeight;    
                    }
                        $('#topnav_msg').html(JSON.parse(resp).topnav_msg.replace(/\\/g, ""));
            
                    }
                });
            }
            
            window.setTimeout(function() {
                var intervalId = window.setInterval(function() {
                fetch_chat(); // fetch new chat data at 5 seconds interval
                }, 5000);
            }, 5000);
        
        // });
        });




        </script>
   @endif


        

 
</div>
 
            </div>
            <!-- wrap  -->
        </div>
        <!-- main  -->
    </div>
 
</body>