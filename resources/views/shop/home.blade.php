@extends('layouts.main_shop')
@section('headers')
   <style>
	   .slider-content { margin-top:15%; } 
   </style>
    <link rel="stylesheet" href="{{asset('assets/store/owl/css/plugins.css')}}">
@endsection
@section('content')


    <!-- header 1 nav -->
    @include('shop.header1') 

 

      
    <!-- Slider Area -->
    <section class="hero-slider">
      <!-- Single Slider -->
      <div class="single-slider" style="background-image: initial;">
        <div class="container">
          <div class="row no-gutters">
            <div class="col-lg-9 offset-lg-3 col-12" style="z-index: 0;">

             
              <div class="" id="slide">
                <!-- Slider area Start -->
                <div class="slider-wrapper slider-wrapper--3 owl-carousel" id="homepage-slider">
                    <!-- Single Slider Start -->
                         <!-- Single Slider Start -->


      @foreach ($store_sliders as $store_slider) 
                  @php
                      if ($store_slider->status=='active') { $bt_status = 'checked'; }  else { $bt_status = ''; }
                  @endphp
 
                        
               

                    <div class="single-slider" style="background-image: url({{asset('storage/uploads/assets/'.$store_slider->background)}});">
                        @php if ($store_slider->type!='picture')  { echo '<div class="overlay"></div>'; $style = ''; }  else { $style = 'margin-top:45%;'; } @endphp
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-lg-12 col-md-12">
                                                        <div class="slider-content text-center" style="<?=$style?>">
                
                  @if (count($store_slider->slider_content)>0)
                      @foreach ($store_slider->slider_content as $slider_content)
                        @if ($slider_content->type=='fl')       {{-- if first level text --}} 
                        <h4 class="heading-secondary" data-animation="fadeInUp" data-delay="0s" data-duration="1s">{{$slider_content->content}}</h4>
                        @elseif ($slider_content->type=='sl')   {{-- if second level text --}} 
                        <h1 class="heading-primary rabeya-heading-primary" data-animation="fadeInUp" data-delay="0s" data-duration="2s">{{$slider_content->content}}</h1>
                        @elseif ($slider_content->type=='tl')   {{-- if third level text --}} 
                        <p class="rabeya-slider-text" data-animation="fadeInUp" data-delay="0s" data-duration="3s">{{$slider_content->content}}</p>
                        @elseif ($slider_content->type=='html')    
                        <div style="color:#fff!important;" class="rabeya-slider-text" data-animation="fadeInUp" data-delay="0s" data-duration="3s"> {!!$slider_content->content!!} </div>
                        @endif 
                      @endforeach
                  @endif 

<a href="{{$store_slider->link_url}}" class="btn slider-btn btn-style-6" data-animation="fadeInUp" data-delay="0s" data-duration="4s">{{$store_slider->link_text}}</a>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>  
                 @endforeach
                    <!-- Single Slider End -->
                </div>
                <!-- Slider area End -->
            </div>

            


              {{-- <div class="text-inner">
                <div class="row">
                  <div class="col-lg-7 col-12">
                    <div class="hero-text">
                      <h1><span>UP TO 50% OFF </span>Shirt For Man</h1>
                      <p>Maboriosam in a nesciung eget magnae <br> dapibus disting tloctio in the find it pereri <br> odiy maboriosm.</p>
                      <div class="button">
                        <a href="#" class="btn">Shop Now!</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div> --}}
            </div>
          </div>
        </div>
      </div>
      <!--/ End Single Slider -->
    </section>
    <!--/ End Slider Area -->
	

	
	<!-- Start Product Area -->
          {{-- XX ====  XX --}}
	<!-- End Product Area -->

	


    <!-- Start Most Popular -->
	<div class="product-area most-popular section">
	@foreach ($store_data['main_categories'] as $main_category)  
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="section-title">
					<h2>{{$main_category->cat_name}}</h2>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-12">
				<div class="owl-carousel popular-slider">
				@foreach ($main_category->products->take(10) as $product)  
				 
						<!-- Start Single Product -->
						<div class="single-product">
							<div class="product-img">
								<a href="#"> 
									<img class="default-img" src="{{asset('storage/uploads/products_img/'.$product->img_name)}}" alt="#">
									<img class="hover-img" src="{{asset('storage/uploads/products_img/'.$product->img_name)}}" alt="#">
								</a>
								<div class="button-head">
									<div class="product-action">
										<a data-toggle="modal" data-target="#exampleModal" title="Quick View" href="#" onclick="product_quickshop_modal('{{$product->product_id}}')"><i class=" ti-eye"></i><span>Quick Shop</span></a>
										<a title="Wishlist" href="#"><i class=" ti-heart "></i><span>Add to Wishlist</span></a>
										<a title="Compare" href="#"><i class="ti-bar-chart-alt"></i><span>Add to Compare</span></a>
									</div>
									<div class="product-action-2">
										<a title="Add to cart" href="#">Add to cart</a>
									</div>
								</div>
							</div>
							<div class="product-content">
								<h3><a href="#">{{$product->prd_name}}</a></h3>
								<div class="product-price">
									{{-- <span class="old">{!!naira()!!}{{number_format($product->price)}}</span> --}}
									<span>{!!naira()!!}{{number_format($product->price)}}</span>
								</div>
							</div>
						</div> 
						<!-- End Single Product --> 
 
				@endforeach
				</div>
			</div>
		</div>
		</div>
	@endforeach
</div>
	<!-- End Most Popular Area -->
	






	<!-- Start Shop Home List  -->
	{{-- <section class="shop-home-list section">
		<div class="container">
			<div class="row">
				<div class="col-lg-4 col-md-6 col-12">
					<div class="row">
						<div class="col-12">
							<div class="shop-section-title">
								<h1>On sale</h1>
							</div>
						</div>
					</div>
					<!-- Start Single List  -->
					<div class="single-list">
						<div class="row">
							<div class="col-lg-6 col-md-6 col-12">
								<div class="list-image overlay">
									<img src="https://via.placeholder.com/115x140" alt="#">
									<a href="#" class="buy"><i class="fa fa-shopping-bag"></i></a>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-12 no-padding">
								<div class="content">
									<h4 class="title"><a href="#">Licity jelly leg flat Sandals</a></h4>
									<p class="price with-discount">$59</p>
								</div>
							</div>
						</div>
					</div>
					<!-- End Single List  -->
					<!-- Start Single List  -->
					<div class="single-list">
						<div class="row">
							<div class="col-lg-6 col-md-6 col-12">
								<div class="list-image overlay">
									<img src="https://via.placeholder.com/115x140" alt="#">
									<a href="#" class="buy"><i class="fa fa-shopping-bag"></i></a>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-12 no-padding">
								<div class="content">
									<h5 class="title"><a href="#">Licity jelly leg flat Sandals</a></h5>
									<p class="price with-discount">$44</p>
								</div>
							</div>
						</div>
					</div>
					<!-- End Single List  -->
					<!-- Start Single List  -->
					<div class="single-list">
						<div class="row">
							<div class="col-lg-6 col-md-6 col-12">
								<div class="list-image overlay">
									<img src="https://via.placeholder.com/115x140" alt="#">
									<a href="#" class="buy"><i class="fa fa-shopping-bag"></i></a>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-12 no-padding">
								<div class="content">
									<h5 class="title"><a href="#">Licity jelly leg flat Sandals</a></h5>
									<p class="price with-discount">$89</p>
								</div>
							</div>
						</div>
					</div>
					<!-- End Single List  -->
				</div>
				<div class="col-lg-4 col-md-6 col-12">
					<div class="row">
						<div class="col-12">
							<div class="shop-section-title">
								<h1>Best Seller</h1>
							</div>
						</div>
					</div>
					<!-- Start Single List  -->
					<div class="single-list">
						<div class="row">
							<div class="col-lg-6 col-md-6 col-12">
								<div class="list-image overlay">
									<img src="https://via.placeholder.com/115x140" alt="#">
									<a href="#" class="buy"><i class="fa fa-shopping-bag"></i></a>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-12 no-padding">
								<div class="content">
									<h5 class="title"><a href="#">Licity jelly leg flat Sandals</a></h5>
									<p class="price with-discount">$65</p>
								</div>
							</div>
						</div>
					</div>
					<!-- End Single List  -->
					<!-- Start Single List  -->
					<div class="single-list">
						<div class="row">
							<div class="col-lg-6 col-md-6 col-12">
								<div class="list-image overlay">
									<img src="https://via.placeholder.com/115x140" alt="#">
									<a href="#" class="buy"><i class="fa fa-shopping-bag"></i></a>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-12 no-padding">
								<div class="content">
									<h5 class="title"><a href="#">Licity jelly leg flat Sandals</a></h5>
									<p class="price with-discount">$33</p>
								</div>
							</div>
						</div>
					</div>
					<!-- End Single List  -->
					<!-- Start Single List  -->
					<div class="single-list">
						<div class="row">
							<div class="col-lg-6 col-md-6 col-12">
								<div class="list-image overlay">
									<img src="https://via.placeholder.com/115x140" alt="#">
									<a href="#" class="buy"><i class="fa fa-shopping-bag"></i></a>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-12 no-padding">
								<div class="content">
									<h5 class="title"><a href="#">Licity jelly leg flat Sandals</a></h5>
									<p class="price with-discount">$77</p>
								</div>
							</div>
						</div>
					</div>
					<!-- End Single List  -->
				</div>
				<div class="col-lg-4 col-md-6 col-12">
					<div class="row">
						<div class="col-12">
							<div class="shop-section-title">
								<h1>Top viewed</h1>
							</div>
						</div>
					</div>
					<!-- Start Single List  -->
					<div class="single-list">
						<div class="row">
							<div class="col-lg-6 col-md-6 col-12">
								<div class="list-image overlay">
									<img src="https://via.placeholder.com/115x140" alt="#">
									<a href="#" class="buy"><i class="fa fa-shopping-bag"></i></a>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-12 no-padding">
								<div class="content">
									<h5 class="title"><a href="#">Licity jelly leg flat Sandals</a></h5>
									<p class="price with-discount">$22</p>
								</div>
							</div>
						</div>
					</div>
					<!-- End Single List  -->
					<!-- Start Single List  -->
					<div class="single-list">
						<div class="row">
							<div class="col-lg-6 col-md-6 col-12">
								<div class="list-image overlay">
									<img src="https://via.placeholder.com/115x140" alt="#">
									<a href="#" class="buy"><i class="fa fa-shopping-bag"></i></a>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-12 no-padding">
								<div class="content">
									<h5 class="title"><a href="#">Licity jelly leg flat Sandals</a></h5>
									<p class="price with-discount">$35</p>
								</div>
							</div>
						</div>
					</div>
					<!-- End Single List  -->
					<!-- Start Single List  -->
					<div class="single-list">
						<div class="row">
							<div class="col-lg-6 col-md-6 col-12">
								<div class="list-image overlay">
									<img src="https://via.placeholder.com/115x140" alt="#">
									<a href="#" class="buy"><i class="fa fa-shopping-bag"></i></a>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-12 no-padding">
								<div class="content">
									<h5 class="title"><a href="#">Licity jelly leg flat Sandals</a></h5>
									<p class="price with-discount">$99</p>
								</div>
							</div>
						</div>
					</div>
					<!-- End Single List  -->
				</div>
			</div>
		</div>
	</section> --}}
	<!-- End Shop Home List  -->
	 
	    
	<!-- Start Shop Services Area -->
	<section class="shop-services section home">
		<div class="container">
			<div class="row">
				<div class="col-lg-3 col-md-6 col-12">
					<!-- Start Single Service -->
					<div class="single-service">
						<i class="ti-rocket"></i>
						<h4>Free shiping</h4>
						<p>Orders over $100</p>
					</div>
					<!-- End Single Service -->
				</div>
				<div class="col-lg-3 col-md-6 col-12">
					<!-- Start Single Service -->
					<div class="single-service">
						<i class="ti-reload"></i>
						<h4>Free Return</h4>
						<p>Within 30 days returns</p>
					</div>
					<!-- End Single Service -->
				</div>
				<div class="col-lg-3 col-md-6 col-12">
					<!-- Start Single Service -->
					<div class="single-service">
						<i class="ti-lock"></i>
						<h4>Sucure Payment</h4>
						<p>100% secure payment</p>
					</div>
					<!-- End Single Service -->
				</div>
				<div class="col-lg-3 col-md-6 col-12">
					<!-- Start Single Service -->
					<div class="single-service">
						<i class="ti-tag"></i>
						<h4>Best Peice</h4>
						<p>Guaranteed price</p>
					</div>
					<!-- End Single Service -->
				</div>
			</div>
		</div>
	</section>
	<!-- End Shop Services Area -->
	
	<!-- Start Shop Newsletter  -->
	{{-- <section class="shop-newsletter section">
		<div class="container">
			<div class="inner-top">
				<div class="row">
					<div class="col-lg-8 offset-lg-2 col-12">
						<!-- Start Newsletter Inner -->
						<div class="inner">
							<h4>Newsletter</h4>
							<p> Subscribe to our newsletter and get <span>10%</span> off your first purchase</p>
							<form action="mail/mail.php" method="get" target="_blank" class="newsletter-inner">
								<input name="EMAIL" placeholder="Your email address" required="" type="email">
								<button class="btn">Subscribe</button>
							</form>
						</div>
						<!-- End Newsletter Inner -->
					</div>
				</div>
			</div>
		</div>
	</section> --}}
	<!-- End Shop Newsletter -->
	

	


     
   @section('footers')
	<script src="{{asset('assets/store/owl/js/plugins.js')}}"></script>
	<script src="{{asset('assets/store/owl/js/main.js')}}"></script>
     
   @endsection
 
 
@endsection