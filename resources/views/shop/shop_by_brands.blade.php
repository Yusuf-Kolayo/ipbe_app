@extends('layouts.main_shop')

@section('content')
 
  
    <!-- header 2 nav -->
    @include('shop.header2') 

     
       		<!-- Breadcrumbs -->
		<div class="breadcrumbs">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<div class="bread-inner">
							<ul class="bread-list">
								<li><a href="index1.html">Home<i class="ti-arrow-right"></i></a></li>
								<li class="active"><a href="blog-single.html">Shop Grid</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- End Breadcrumbs -->
		
		<!-- Product Style -->
		<section class="product-area shop-sidebar shop section">
			<div class="container">
				<div class="row">
					<div class="col-lg-3 col-md-4 col-12">
						<div class="shop-sidebar">
								<!-- Single Widget -->
								<div class="single-widget category">
									<h3 class="title">Categories </h3>
									<ul class="categor-list">
										@foreach ($store_data['main_categories'] as $main_category) 
									     	<li class="d-block"><a href="{{route('shop.shop_by_categories', ['cat_id'=>$main_category->id, 'slug'=>$main_category->cat_name_hard()])}}">{{$main_category->cat_name}}</a></li> 
										@endforeach
									</ul>
								</div>
								<!--/ End Single Widget -->
								<!-- Shop By Price -->
									<div class="single-widget range">
										<h3 class="title">Shop by Price</h3>
										{{-- <div class="price-filter">
											<div class="price-filter-inner">
												<div id="slider-range"></div>
													<div class="price_slider_amount">
													<div class="label-input">
														<span>Range:</span><input type="text" id="amount" name="price" placeholder="Add Your Price"/>
													</div>
												</div>
											</div>
										</div> --}}
										<ul class="check-box-list">
											@if ($price_array)
                                                 @if (count($price_array)>2)
												 <li>
													<label class="checkbox-inline" for="1"><input name="price_range_1" class="price_range" checked id="1" value="{{$price_array[0]}}:{{$price_array[1]}}" type="checkbox">{!!naira()!!}{{number_format($price_array[0])}} - {!!naira()!!}{{number_format($price_array[1])}}</label>
												</li>
												<li>
													<label class="checkbox-inline" for="2"><input name="price_range_2" class="price_range" checked id="2" value="{{$price_array[1]}}:{{$price_array[2]}}" type="checkbox">{!!naira()!!}{{number_format($price_array[1])}} - {!!naira()!!}{{number_format($price_array[2])}}</label>
												</li>
												<li>
													<label class="checkbox-inline" for="3"><input name="price_range_3" class="price_range" checked id="3" value="{{$price_array[2]}}:{{$price_array[3]}}" type="checkbox">{!!naira()!!}{{number_format($price_array[2])}} - {!!naira()!!}{{number_format($price_array[3])}}</label>
												</li>
												<li>
													<label class="checkbox-inline" for="4"><input name="price_range_4" class="price_range" checked id="4" value="{{$price_array[3]}}:{{$price_array[4]}}" type="checkbox">{!!naira()!!}{{number_format($price_array[3])}} - {!!naira()!!}{{number_format($price_array[4])}}</label>
												</li>
												@else
												<li>
													<label class="checkbox-inline" for="1"><input name="price_range_1" class="price_range" checked id="1" value="{{$price_array[0]}}:{{$price_array[1]}}" type="checkbox">{!!naira()!!}0 - {!!naira()!!}0</label>
												</li>
												 @endif
											@else
											<li>
												<label class="checkbox-inline" for="1"><input name="price_range_1" checked id="1" type="checkbox">{!!naira()!!}0 - {!!naira()!!}0</label>
											</li>
											@endif 
										</ul>
									</div>
									<!--/ End Shop By Price -->
						 
								<!-- Single Widget -->
								<div class="single-widget category">
									<h3 class="title">Brands</h3>   
									<input id="fetch_mode" type="hidden" value="brand_id" />
									<input id="fetch_id" type="hidden" value="{{$brand->id}}" />

									<ul class="categor-list">
										@foreach ($store_data['brands'] as $brand) 
									    	<li class="d-block"><a href="{{route('shop.shop_by_brands', ['brand_id'=>$brand->id, 'slug'=>$brand->brd_name])}}">{{$brand->brd_name}}</a></li> 
										@endforeach
									</ul>
								</div>
								<!--/ End Single Widget -->
						</div>
					</div>
					<div class="col-lg-9 col-md-8 col-12">
						<div class="row">
							<div class="col-12">
								<!-- Shop Top -->
								<div class="shop-top">
									<div class="shop-shorter">
										<div class="single-shorter">
                                          <h6 class="mb-0">Brand: {{$brand->brd_name}}</h6>
										</div>
										{{-- <div class="single-shorter">
											<label>Show :</label>
											<select>
												<option selected="selected">09</option>
												<option>15</option>
												<option>25</option>
												<option>30</option>
											</select>
										</div> --}}

										<div class="single-shorter">
											<label>Sort By :</label>
											<select style="margin-top:5px;" id="select_ordering">
												<option value="prd_name_asc">Product Name (ascending)</option>
												<option value="prd_name_desc">Product Name (descending)</option>
												<option value="prd_price_asc">Product Price (ascending)</option>
												<option value="prd_price_desc">Product Price (descending)</option>
											</select>
										</div>


									</div>
									<ul class="view-mode">
										<li class="active"><a href="JavaScript:void(0)"><i class="fa fa-th-large"></i></a></li>
										<li><a href="JavaScript:void(0)"><i class="fa fa-th-list"></i></a></li>
									</ul>
								</div>
								<!--/ End Shop Top -->
							</div>
						</div>

                        <div id="product_ready_div" class="mt-3 p-3 bg-white border rounded">
							@if (count($products)>0)
							<div class="row">
								@foreach ($products as $product)
									
										<div class="col-lg-4 col-md-6 col-12">
											<div class="single-product">
												<div class="product-img">
													<a href="product-details.html">
														<img class="default-img" src="{{asset('storage/uploads/products_img/'.$product->img_name)}}" alt="#">
														<img class="hover-img" src="{{asset('storage/uploads/products_img/'.$product->img_name)}}" alt="#">
													</a>
													<div class="button-head">
														<div class="product-action">
															<a data-toggle="modal" data-target="#exampleModal" title="Quick View" onclick="product_quickshop_modal('{{$product->product_id}}')" href="#"><i class=" ti-eye"></i><span>Quick Shop</span></a>
															{{-- <a title="Wishlist" href="#"><i class=" ti-heart "></i><span>Add to Wishlist</span></a>
															<a title="Compare" href="#"><i class="ti-bar-chart-alt"></i><span>Add to Compare</span></a> --}}
														</div>
														<div class="product-action-2">
															<a title="Add to cart" href="#">Add to cart</a>
														</div>
													</div>
												</div>
												<div class="product-content">
													<h3><a href="product-details.html">{{$product->prd_name}}</a></h3>
													<div class="product-price">
														<span>{!!naira()!!}{{number_format($product->price)}}</span>
													</div>
												</div>
											</div>
										</div>
	
								@endforeach
							</div>
							@else
								<p class="text-center mt-4 p-3 bg-light">no products found under this category!</p>
							@endif
						</div>

						
					</div>
				</div>
			</div>
		</section>
		<!--/ End Product Style 1  -->	


   





		@component('components.shop_catalog_ext')
	    	{{-- @slot('fetch_mode') brand_id @endslot --}}
    	@endcomponent

 
@endsection