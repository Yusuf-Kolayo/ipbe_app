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
            <div class="col-lg-9 offset-lg-3 col-12">

             
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
	
	<!-- Start Small Banner  -->
	{{-- <section class="small-banner section">
	   <div class="container">
      <div class="">
        <div class="row">
          <!-- Single Banner  -->
          <div class="col-lg-4 col-md-6 col-12">
            <div class="single-banner">
              <img src="https://via.placeholder.com/600x370" alt="#">
              <div class="content">
                <p>Man's Collectons</p>
                <h3>Summer travel <br> collection</h3>
                <a href="#">Discover Now</a>
              </div>
            </div>
          </div>
          <!-- /End Single Banner  -->
          <!-- Single Banner  -->
          <div class="col-lg-4 col-md-6 col-12">
            <div class="single-banner">
              <img src="https://via.placeholder.com/600x370" alt="#">
              <div class="content">
                <p>Bag Collectons</p>
                <h3>Awesome Bag <br> 2020</h3>
                <a href="#">Shop Now</a>
              </div>
            </div>
          </div>
          <!-- /End Single Banner  -->
          <!-- Single Banner  -->
          <div class="col-lg-4 col-12">
            <div class="single-banner tab-height">
              <img src="https://via.placeholder.com/600x370" alt="#">
              <div class="content">
                <p>Flash Sale</p>
                <h3>Mid Season <br> Up to <span>40%</span> Off</h3>
                <a href="#">Discover Now</a>
              </div>
            </div>
          </div>
          <!-- /End Single Banner  -->
        </div>
      </div>
     </div>
	</section> --}}
	<!-- End Small Banner -->
	
	<!-- Start Product Area -->
    <div class="product-area section">
            <div class="container">
				<div class="row">
					<div class="col-12">
						<div class="section-title">
							<h2>Trending Items</h2>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-12">
						<div class="product-info">
							<div class="nav-main">
								<!-- Tab Nav -->
								<ul class="nav nav-tabs" id="myTab" role="tablist">
									@php $sn=0; @endphp  
									@foreach ($store_data['main_categories'] as $main_category)
									@php $sn++; if($sn==1) { $active='active'; } else { $active=''; } @endphp
									<li class="nav-item"><a class="nav-link {{$active}}" data-toggle="tab" href="#{{$main_category->cat_name_hard()}}" role="tab">{{$main_category->cat_name}}</a></li>
									@endforeach 
								</ul>
								<!--/ End Tab Nav -->
							</div>
							<div class="tab-content" id="myTabContent">
								@php $sn=0; @endphp
								@foreach ($store_data['main_categories'] as $main_category)  
								@php $sn++; if($sn==1) { $active='active'; $show='show'; } else { $active=''; $show=''; } @endphp
								
									<!-- Start Single Tab -->
									<div class="tab-pane fade  {{"$show $active"}}" id="{{$main_category->cat_name_hard()}}" role="tabpanel">
										<div class="tab-single">
											<div class="row">
												@foreach ($main_category->products->take(4) as $product)  
												<div class="col-xl-3 col-lg-4 col-md-4 col-12">
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
																	{{-- <a title="Compare" href="#"><i class="ti-bar-chart-alt"></i><span>Add to Compare</span></a> --}}
																</div>
																<div class="product-action-2">
																	<a title="Add to cart" href="#">Add to cart</a>
																</div>
															</div>
														</div>
														<div class="product-content">
															<h3 class="text-center"><a href="#">{{$product->prd_name}}</a></h3>
															<div class="product-price text-center">
																<span>{{number_format($product->price)}}</span>
															</div>
														</div>
													</div> 
												</div> 
												@endforeach  
											</div>
											<div class="mt-3 text-center pt-5">  <span style="margin-top: 20px; 
												box-shadow: 0px 0px 9px 1px #ededed; padding:10px;
												color: #46b9eb;"><a href="">See More {{$main_category->cat_name}}</a></span>  </div>
										</div>
									</div>
									<!--/ End Single Tab -->
								 
								@endforeach 
							 
							</div>
						</div>
					</div>
				</div>
            </div>
    </div>
	<!-- End Product Area -->
	
	<!-- Start Midium Banner  -->
	<section class="midium-banner">
		<div class="container">
			<div class="row">
				<!-- Single Banner  -->
				<div class="col-lg-6 col-md-6 col-12">
					<div class="single-banner">
						<img src="https://via.placeholder.com/600x370" alt="#">
						<div class="content">
							<p>Man's Collectons</p>
							<h3>Man's items <br>Up to<span> 50%</span></h3>
							<a href="#">Shop Now</a>
						</div>
					</div>
				</div>
				<!-- /End Single Banner  -->
				<!-- Single Banner  -->
				<div class="col-lg-6 col-md-6 col-12">
					<div class="single-banner">
						<img src="https://via.placeholder.com/600x370" alt="#">
						<div class="content">
							<p>shoes women</p>
							<h3>mid season <br> up to <span>70%</span></h3>
							<a href="#" class="btn">Shop Now</a>
						</div>
					</div>
				</div>
				<!-- /End Single Banner  -->
			</div>
		</div>
	</section>
	<!-- End Midium Banner -->
	
	<!-- Start Most Popular -->
	<div class="product-area most-popular section">
        <div class="container">
            <div class="row">
				<div class="col-12">
					<div class="section-title">
						<h2>Hot Item</h2>
					</div>
				</div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="owl-carousel popular-slider">
						<!-- Start Single Product -->
						<div class="single-product">
							<div class="product-img">
								<a href="#">
									<img class="default-img" src="https://via.placeholder.com/550x750" alt="#">
									<img class="hover-img" src="https://via.placeholder.com/550x750" alt="#">
									<span class="out-of-stock">Hot</span>
								</a>
								<div class="button-head">
									<div class="product-action">
										<a data-toggle="modal" data-target="#exampleModal" title="Quick View" href="#"><i class=" ti-eye"></i><span>Quick Shop</span></a>
										<a title="Wishlist" href="#"><i class=" ti-heart "></i><span>Add to Wishlist</span></a>
										<a title="Compare" href="#"><i class="ti-bar-chart-alt"></i><span>Add to Compare</span></a>
									</div>
									<div class="product-action-2">
										<a title="Add to cart" href="#">Add to cart</a>
									</div>
								</div>
							</div>
							<div class="product-content">
								<h3><a href="#">Black Sunglass For Women</a></h3>
								<div class="product-price">
									<span class="old">$60.00</span>
									<span>$50.00</span>
								</div>
							</div>
						</div>
						<!-- End Single Product -->
						<!-- Start Single Product -->
						<div class="single-product">
                            <div class="product-img">
                                <a href="#">
                                    <img class="default-img" src="https://via.placeholder.com/550x750" alt="#">
                                    <img class="hover-img" src="https://via.placeholder.com/550x750" alt="#">
                                </a>
								<div class="button-head">
									<div class="product-action">
										<a data-toggle="modal" data-target="#exampleModal" title="Quick View" href="#"><i class=" ti-eye"></i><span>Quick Shop</span></a>
										<a title="Wishlist" href="#"><i class=" ti-heart "></i><span>Add to Wishlist</span></a>
										<a title="Compare" href="#"><i class="ti-bar-chart-alt"></i><span>Add to Compare</span></a>
									</div>
									<div class="product-action-2">
										<a title="Add to cart" href="#">Add to cart</a>
									</div>
								</div>
                            </div>
                            <div class="product-content">
                                <h3><a href="#">Women Hot Collection</a></h3>
                                <div class="product-price">
                                    <span>$50.00</span>
                                </div>
                            </div>
                        </div>
						<!-- End Single Product -->
						<!-- Start Single Product -->
						<div class="single-product">
                            <div class="product-img">
                                <a href="#">
                                    <img class="default-img" src="https://via.placeholder.com/550x750" alt="#">
                                    <img class="hover-img" src="https://via.placeholder.com/550x750" alt="#">
									<span class="new">New</span>
                                </a>
								<div class="button-head">
									<div class="product-action">
										<a data-toggle="modal" data-target="#exampleModal" title="Quick View" href="#"><i class=" ti-eye"></i><span>Quick Shop</span></a>
										<a title="Wishlist" href="#"><i class=" ti-heart "></i><span>Add to Wishlist</span></a>
										<a title="Compare" href="#"><i class="ti-bar-chart-alt"></i><span>Add to Compare</span></a>
									</div>
									<div class="product-action-2">
										<a title="Add to cart" href="#">Add to cart</a>
									</div>
								</div>
                            </div>
                            <div class="product-content">
                                <h3><a href="#">Awesome Pink Show</a></h3>
                                <div class="product-price">
                                    <span>$50.00</span>
                                </div>
                            </div>
                        </div>
						<!-- End Single Product -->
						<!-- Start Single Product -->
						<div class="single-product">
                            <div class="product-img">
                                <a href="#">
                                    <img class="default-img" src="https://via.placeholder.com/550x750" alt="#">
                                    <img class="hover-img" src="https://via.placeholder.com/550x750" alt="#">
                                </a>
								<div class="button-head">
									<div class="product-action">
										<a data-toggle="modal" data-target="#exampleModal" title="Quick View" href="#"><i class=" ti-eye"></i><span>Quick Shop</span></a>
										<a title="Wishlist" href="#"><i class=" ti-heart "></i><span>Add to Wishlist</span></a>
										<a title="Compare" href="#"><i class="ti-bar-chart-alt"></i><span>Add to Compare</span></a>
									</div>
									<div class="product-action-2">
										<a title="Add to cart" href="#">Add to cart</a>
									</div>
								</div>
                            </div>
                            <div class="product-content">
                                <h3><a href="#">Awesome Bags Collection</a></h3>
                                <div class="product-price">
                                    <span>$50.00</span>
                                </div>
                            </div>
                        </div>
						<!-- End Single Product -->
                    </div>
                </div>
            </div>
        </div>
    </div>
	<!-- End Most Popular Area -->
	
	<!-- Start Shop Home List  -->
	<section class="shop-home-list section">
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
	</section>
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
	
	<!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span class="ti-close" aria-hidden="true"></span></button>
                    </div>
                    <div class="modal-body" style="height: initial;">
						<div id="quickshop_ready_div">
							<div class="text-center mt-4"> <img src="{{asset('images/preloader1.gif')}}" class="img mx-auto mt-4" alt=""> </div>  
						</div> 
                    </div>
                </div>
            </div>
    </div>
    <!-- Modal end -->
	


     
   @section('footers')
	<script src="{{asset('assets/store/owl/js/plugins.js')}}"></script>
	<script src="{{asset('assets/store/owl/js/main.js')}}"></script>
    
	<script>
		function product_quickshop_modal(product_id) {   
		$('#quickshop_ready_div').html('<div class="text-center mt-5 mb-5"> <img src=" {{ asset('images/preloader1.gif') }} " class="img mx-auto" alt=""> </div>');
		// $('#quickshop_ready_div').html('');  
			var data2send={'product_id':product_id};  
			$.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $("meta[name=csrf-token]").attr('content') }  });
			$.ajax({
				url:"{{ route('shop.product_quickshop') }}",
				dataType:"text",
				method:"GET",
				data:data2send,
				success:function(resp){
					$('#quickshop_ready_div').html(resp);
				}
		  }); 
		}
	</script>
	
   @endsection
 
 
@endsection