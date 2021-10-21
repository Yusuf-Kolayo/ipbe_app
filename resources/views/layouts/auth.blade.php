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

    <style>
    .logo-img { max-height: 31px;  }
    .nk-auth-body, .nk-auth-footer {
    max-width: 430px!important;
    margin-left: auto;  margin-right: auto;
    }
    .form-control:focus {  box-shadow: 0 0 0 3px #fff; }
    .bg-dark {  background-color: #0e1c2d!important; }
    .form-control:focus { border-color: #101924;  }
    </style>

</head>

<body class="nk-body bg-dark npc-general pg-auth">
    <div class="nk-app-root">
        <!-- main @s -->
        <div class="nk-main ">
            <!-- wrap @s -->
            <div class="nk-wrap nk-wrap-nosidebar">
                <!-- content @s -->
                <div class="nk-content ">
                    <div class="nk-block nk-block-middle nk-auth-body  wide-xs">
                        <!--<div class="brand-logo pb-4 text-center">-->
                        <!--    <a href="#" class="logo-link">-->
                        <!--        <img class="logo-light logo-img logo-img-lg" src="global_assets/images/dap_logo_reversed.png" srcset="admin/images/logo2x.png 2x" alt="logo">-->
                        <!--        <img class="logo-dark logo-img logo-img-lg" src="global_assets/images/dap_logo_reversed.png" srcset="admin/images/logo-dark2x.png 2x" alt="logo-dark">-->
                        <!--    </a>-->
                        <!--</div>-->

                     
                        @yield('content')


                    </div>


                    <!-- <div class="nk-footer nk-auth-footer-full">
                        <div class="container wide-lg">
                            <div class="row g-3">
                                <div class="col-lg-6 order-lg-last">
                                    <ul class="nav nav-sm justify-content-center justify-content-lg-end">
                                        <li class="nav-item">
                                            <a class="nav-link" href="#">Terms & Condition</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#">Privacy Policy</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#">Help</a>
                                        </li>
                                   
                                    </ul>
                                </div>
                                <div class="col-lg-6">
                                    <div class="nk-block-content text-center text-lg-left">
                                        <p class="text-soft">&copy; 2020 Double Assure Prudential. All Rights Reserved.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->

                </div>
                <!-- wrap  -->
            </div>
            <!-- content @e -->
        </div>
        <!-- main @e -->
    </div>
    <!-- app-root @e -->
    <!-- JavaScript -->
       <!-- JavaScript -->

    <script src="admin/assets/js/bundle.js?ver=2.2.0"></script>  
    <script src="admin/assets/js/scripts.js?ver=2.2.0"></script> 




</html>