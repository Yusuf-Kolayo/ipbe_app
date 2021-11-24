<!DOCTYPE html>
<html lang="zxx">
<head>
	<!-- Meta Tag -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name='copyright' content=''>
  <meta http-equiv="pragma" content="no-cache" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="csrf-token" content="{{ csrf_token() }}">

	<!-- Title Tag  -->
  <title> {{ $store_data['business_info']->name}} - {{$store_data['business_info']->slogan}}</title>
   <link rel="icon" href="{{ asset('storage/uploads/assets/'.$store_data['business_info']->logo) }}" type="image/png" />
   <!-- Web Font -->
	<link href="https://fonts.googleapis.com/css?family=Poppins:200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">
		<!-- StyleSheet -->
	
	<!-- Bootstrap -->
	<link rel="stylesheet" href="{{ asset('assets/store/css/bootstrap.css') }}">
	<!-- Magnific Popup -->
    <link rel="stylesheet" href="{{ asset('assets/store/css/magnific-popup.min.css') }}">
	<!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('assets/store/css/font-awesome.css') }}">
	<!-- Fancybox -->
	<link rel="stylesheet" href="{{ asset('assets/store/css/jquery.fancybox.min.css') }}">
	<!-- Themify Icons -->
    <link rel="stylesheet" href="{{ asset('assets/store/css/themify-icons.css') }}">
	<!-- Nice Select CSS -->
    <link rel="stylesheet" href="{{ asset('assets/store/css/niceselect.css') }}">
	<!-- Animate CSS -->
    <link rel="stylesheet" href="{{ asset('assets/store/css/animate.css') }}">
	<!-- Flex Slider CSS -->
    <link rel="stylesheet" href="{{ asset('assets/store/css/flex-slider.min.css') }}">
	<!-- Owl Carousel -->
    <link rel="stylesheet" href="{{ asset('assets/store/css/owl-carousel.css') }}">
	<!-- Slicknav -->
    <link rel="stylesheet" href="{{ asset('assets/store/css/slicknav.min.css') }}">
	
	<!-- Eshop StyleSheet -->
	<link rel="stylesheet" href="{{ asset('assets/store/css/reset.css') }}">
	<link rel="stylesheet" href="{{asset('assets/store/css/style.css')}}">
  <link rel="stylesheet" href="{{ asset('assets/store/css/responsive.css') }}">
  @yield('headers')
  </head>
  
  
   


  <body class="js">
	   
    <!-- Preloader -->
    <div class="preloader">
      <div class="preloader-inner">
        <div class="preloader-icon">
          <span></span>
          <span></span>
        </div>
      </div>
    </div>
    <!-- End Preloader -->
    



    {{-- content  --}}
    @yield('content') 

    
    {{-- footer  --}}
    @include('shop.footer')


    <!-- Jquery -->
    <script src="{{ asset('assets/store/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/store/js/jquery-migrate-3.0.0.js') }}"></script>
    <script src="{{ asset('assets/store/js/jquery-ui.min.js') }}"></script>
    <!-- Popper JS -->
    <script src="{{ asset('assets/store/js/popper.min.js') }}"></script>
    <!-- Bootstrap JS -->
    <script src="{{ asset('assets/store/js/bootstrap.min.js') }}"></script>
    <!-- Color JS -->
    <script src="{{ asset('assets/store/js/colors.js') }}"></script>
    <!-- Slicknav JS -->
    <script src="{{ asset('assets/store/js/slicknav.min.js') }}"></script>
    <!-- Owl Carousel JS -->
    <script src="{{ asset('assets/store/js/owl-carousel.js') }}"></script>
    <!-- Magnific Popup JS -->
    <script src="{{ asset('assets/store/js/magnific-popup.js') }}"></script>
    <!-- Waypoints JS -->
    <script src="{{ asset('assets/store/js/waypoints.min.js') }}"></script>
    <!-- Countdown JS -->
    <script src="{{ asset('assets/store/js/finalcountdown.min.js') }}"></script>
    <!-- Nice Select JS -->
    <script src="{{ asset('assets/store/js/nicesellect.js') }}"></script>
    <!-- Flex Slider JS -->
    <script src="{{ asset('assets/store/js/flex-slider.js') }}"></script>
    <!-- ScrollUp JS -->
    <script src="{{ asset('assets/store/js/scrollup.js') }}"></script>
    <!-- Onepage Nav JS -->
    <script src="{{ asset('assets/store/js/onepage-nav.min.js') }}"></script>
    <!-- Easing JS -->
    <script src="{{ asset('assets/store/js/easing.js') }}"></script>
    <!-- Active JS -->
    <script src="{{ asset('assets/store/js/active.js') }}"></script>


    @yield('footers')
  </body>
</html>
