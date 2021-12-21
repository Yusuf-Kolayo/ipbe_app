<div class="row no-gutters mt-4">
    <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12 col-12">
        <!-- Product Slider -->
            <div class="product-gallery">
                <div class="quickview-slider-active">
                    <div class="single-slider">
                        <img class="img img-fluid" src="{{asset('storage/uploads/products_img/'.$product->img_name)}}" alt="#">
                    </div>
                  {{--    <div class="single-slider">
                        <img src="{{asset('storage/uploads/products_img/'.$product->img_name)}}" alt="#">
                    </div> 
                    <div class="single-slider">
                        <img src="{{asset('storage/uploads/products_img/'.$product->img_name)}}" alt="#">
                    </div>
                    <div class="single-slider">
                        <img src="{{asset('storage/uploads/products_img/'.$product->img_name)}}" alt="#">
                    </div> --}}


                    {{-- <div class="single-slider">
                        <img src="https://via.placeholder.com/569x528" alt="#">
                    </div>
                    <div class="single-slider">
                        <img src="https://via.placeholder.com/569x528" alt="#">
                    </div>
                    <div class="single-slider">
                        <img src="https://via.placeholder.com/569x528" alt="#">
                    </div>
                    <div class="single-slider">
                        <img src="https://via.placeholder.com/569x528" alt="#">
                    </div> --}}
                </div>
            </div>
        <!-- End Product slider -->
    </div>
    <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12 col-12">
        <div class="quickview-content">
            <h2>{{$product->prd_name}}</h2>
            <div class="quickview-ratting-review">
                <div class="quickview-ratting-wrap">
                    <div class="quickview-ratting">
                        <i class="yellow fa fa-star"></i>
                        <i class="yellow fa fa-star"></i>
                        <i class="yellow fa fa-star"></i>
                        <i class="yellow fa fa-star"></i>
                        <i class="fa fa-star"></i>
                    </div>
                    <a href="#"> (1 customer review)</a>
                </div>
                <div class="quickview-stock">
                    <span><i class="fa fa-check-circle-o"></i> in stock</span>
                </div>
            </div>
            <h3>{!! naira() !!} {{ number_format($product->price)}}</h3>
            <div class="quickview-peragraph mb-4">
                <p>{!!$product->description!!}</p>
            </div>
            {{-- <div class="size">
                <div class="row">
                    <div class="col-lg-6 col-12">
                        <h5 class="title">Size</h5>
                        <select>
                            <option selected="selected">s</option>
                            <option>m</option>
                            <option>l</option>
                            <option>xl</option>
                        </select>
                    </div>
                    <div class="col-lg-6 col-12">
                        <h5 class="title">Color</h5>
                        <select>
                            <option selected="selected">orange</option>
                            <option>purple</option>
                            <option>black</option>
                            <option>pink</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="quantity">
                <!-- Input Order -->
                <div class="input-group">
                    <div class="button minus">
                        <button type="button" class="btn btn-primary btn-number" disabled="disabled" data-type="minus" data-field="quant[1]">
                            <i class="ti-minus"></i>
                        </button>
                    </div>
                    <input type="text" name="quant[1]" class="input-number"  data-min="1" data-max="1000" value="1">
                    <div class="button plus">
                        <button type="button" class="btn btn-primary btn-number" data-type="plus" data-field="quant[1]">
                            <i class="ti-plus"></i>
                        </button>
                    </div>
                </div>
                <!--/ End Input Order -->
            </div> --}}
            <div class="add-to-cart">
                <div class="row"> 
                    <div class="col-12 col-md-8">
                        <table border="0" cellpadding="2" cellspacing="4" width="100%" class="mb-0">
                            <tr>   
                            {{-- @guest --}}

                                <th width="65%" class="p-1">
                                    {!! Form::open(['route' => ['buy',['product_id'=>$product->product_id,'purchase_type'=>'buy_now']], 'method'=>'POST', 'files' => false, 'class'=>'mb-0']) !!}
                                    <button type="submit" class="btn btn-block w-100 m-0">Buy Now</button>
                                    {!! Form::close() !!}
                                </th>  
                                <td width="35%" class="p-1">
                                    {!! Form::open(['route' => ['buy',['product_id'=>$product->product_id,'purchase_type'=>'installment']], 'method'=>'POST', 'files' => false, 'class'=>'mb-0']) !!}
                                    <button type="submit" class="btn btn-block w-100 m-0">Installment</button>
                                    {!! Form::close() !!}                                
                                </td>
                            
                            {{-- @else
                            <th width="65%" class="p-1"><a href="#" class="btn btn-block w-100 m-0">Buy in Installment</a></th>  
                            <td width="35%" class="p-1"><a href="#" class="btn btn-block w-100 m-0">Buy now</a></td>
                            @endguest
                            </tr> --}}
                        </table>
                    </div>
                </div> 
            </div>
            <div class="default-social">
                <h4 class="share-now">Share:</h4>
                <ul>
                    <li><a class="facebook" href="#"><i class="fa fa-facebook"></i></a></li>
                    <li><a class="twitter" href="#"><i class="fa fa-twitter"></i></a></li>
                    <li><a class="youtube" href="#"><i class="fa fa-pinterest-p"></i></a></li>
                    <li><a class="dribbble" href="#"><i class="fa fa-google-plus"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
