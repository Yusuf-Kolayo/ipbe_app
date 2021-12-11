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



<div class="row mt-2">
    <div class="col-12">
      <div>
  <ul class="pagination pagination-sm">
      @php 
      if ($products->currentPage()==1) {
          if ($products->hasMore==true) { $prev_class= 'disabled d-inline-block'; $next_class= 'd-inline-block'; $prev_onclick=''; $next_onclick='fetch_next('.$products->currentPage().')'; } 
                                   else { $prev_class= 'd-none'; $next_class= 'd-none'; $prev_onclick='fetch_prev('.$products->currentPage().')'; $next_onclick='';  }  
      } else {  //current page more > 1
          if ($products->hasMore==true) { $prev_class= 'd-inline-block'; $next_class= 'd-inline-block'; $prev_onclick='fetch_prev('.$products->currentPage().')'; $next_onclick='fetch_next('.$products->currentPage().')'; } 
                                   else { $prev_class= 'd-inline-block'; $next_class= 'disabled d-inline-block'; $prev_onclick='fetch_prev('.$products->currentPage().')'; $next_onclick=''; }  
      } 
      @endphp
      
        <li class="page-item {{$prev_class}}" style="width: fit-content;"><span class="page-link" onclick="{{$prev_onclick}}">Prev</span></li> 
        <li class="page-item {{$next_class}}" style="width: fit-content;"><span class="page-link" onclick="{{$next_onclick}}">Next</span></li>
    
  </ul> 
  </div>
    </div>
</div>