@extends('layouts.main')

@section('content')
    @admin
    <div class="w-100 text-right mb-3">
        <h5 class="mb-0 float-left"> <i class="fas fa-shopping-cart"></i> Catalog Management</h5>
        <button data-toggle="collapse" data-target="#add_new" class="btn btn-primary btn-sm"> Add New </button>
    </div>
    <div class="card collapse" id="add_new">
        <div class="card-header">{{ __('Product Registry') }}</div> 
        <div class="card-body">
            
            {!! Form::open(['route' => ['product.store'], 'method'=>'POST', 'files' => true]) !!} 
          <div class="row ">
                <div class="col-md-12 text-center pb-4">
                      <img src="{{asset('images/product_place_holder.jpeg')}}" alt="" class="img img-fluid" id="preview_img" style="height:200px;"/>
                </div>  
                    
                <div class="col-md-6">
                    <div class="form-group">
                        <label>  Product Picture </label>
                        <input type="file" class="form-control" required name="img_name" id="img_name"/>  
                      </div>   
                </div>   

                <div class="col-md-6">
                    <div class="form-group">
                        <label> Name </label>
                        <input type="text" class="form-control" required name="prd_name"/> 
                    </div>
                </div> 



                <div class="col-md-12">
                    <div class="form-group">
                      <label> Description </label>
                      <textarea name="description" id="textarea" class="form-control"  rows="2"></textarea>
                    </div>
                  </div>


                <div class="col-md-6">
                    <div class="form-group">
                      <label> Brand </label>
                      <select name="brand_id" id="brand_id" class="form-control">
                        <option value=""></option> 
                        @foreach ($brands as $brand)
                          <option value="{{$brand->id}}">{{$brand->brd_name}}</option>
                        @endforeach
                        </select> 
                    </div>
                </div>


                <div class="col-md-6">
                    <div class="form-group">
                      <label> Price </label>
                      <input type="number" name="price" id="price" class="form-control">
                    </div>
                </div>


                <div class="col-md-6">
                    <div class="form-group">
                      <label> Main Category </label>
                      <select name="main_category_id" id="main_category_id" onchange="fetch_sub_cat();" class="form-control">
                        <option value=""></option> 
                        @foreach ($main_categories as $main_category)
                          <option value="{{$main_category->id}}">{{$main_category->cat_name}}</option>
                        @endforeach
                        </select> 
                    </div>
                </div>


                <div class="col-md-6">
                    <div class="form-group">
                      <label> Sub Category </label>
                      <select name="sub_category_id" class="form-control" id="sub_category_id">
                        <option value=""></option>  
                    </select> 
                    </div>
                </div> 
                

                <div class="col-md-12  pt-4">
                      <input type="submit" value="Submit" class="btn btn-primary btn-block w-75 mx-auto">
                </div>




            </div>
            {!! Form::close() !!} 
        </div> 
    </div> 
    @endadmin

    @agent
      <div class="w-100 text-right mb-3" style="display: inline-block;">
          <h5 class="mb-0 float-left"> <i class="fas fa-shopping-cart"></i> Product Catalog</h5>
      </div>
    @endagent
    
        <p class="">{{$sub_category->parent->cat_name}} > <b>{{$sub_category->cat_name}}</b></p>
     
 @php  if (count($products)>0) { @endphp
  <div id="data_box">
    <div class="row">
        @foreach ($products as $product)
            <div class="col-md-4" id="DIV-{{$product->product_id}}">
                <div class="card">
                    <div class="card-header">
                      <img src="{{asset('storage/uploads/products_img/'.$product->img_name)}}" alt="" class="img img-fluid">
                    </div>
                    <div class="card-body"> 
                      <h6>{{$product->prd_name}}</h6> 
                      <p>{{$product->description}}</p>
                      <div class="row">
                        @admin
                          <div class="col-6"> <button class="btn btn-primary btn-block" onclick="update_product_modal('{{$product->product_id}}')"> <i class="fas fa-edit"></i> Edit</button>  </div>
                          <div class="col-6"> <button class="btn btn-danger btn-block" onclick="delete_product_modal('{{$product->product_id}}')"> <i class="fas fa-trash"></i> Delete</button>  </div>
                        @endadmin
                        @agent
                          <div class="col-12"> <button class="btn btn-outline-primary btn-block" onclick="select_product_modal('{{$product->product_id}}')"> Select </button>  </div>
                        @endagent
                      </div>
                    </div>
                </div>
            </div>
        @endforeach  
    </div>
    <div class="row">
        <div class="col-12">
          {{$products->links()}}
        </div>
    </div>
  </div>


<!-- UPDATE BANNER MODAL -->
@admin
  <div class="modal fade" id="update_product_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="" role="document">

      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" style="display:inline;" id="exampleModalLabel"> Update Product </h5>
          <button type="button" style="float:right;"  class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        {!! Form::open(['route' => ['product.update', ['product'=>$product->product_id]], 'method'=>'POST', 'files' => true, 'id'=>'product_update_form', ]) !!} 
          <div class="modal-body" id="update_ready_div">
            <div class="text-center"> <img src="{{asset('images/preloader1.gif')}}" class="img mx-auto" alt=""> </div>   
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button class="btn btn-primary" type="submit" name="update_product_btn" >Update</button>
          </div>
        {!! Form::close() !!} 
      </div> 
    </div>
  </div>


  <!-- DELETE BANNER MODAL -->
  <div class="modal fade" id="delete_product_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="" role="document">

      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" style="display:inline;" id="exampleModalLabel"> Are you sure to delete this product ?</h5>
          <button type="button" style="float:right;"  class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        {!! Form::open(['route' => ['product.destroy', ['product'=>$product->product_id]], 'method'=>'POST', 'files' => true, 'id'=>'product_delete_form', ]) !!} 
        @method('DELETE')
        <div class="modal-body" id="delete_ready_div">
            <div class="text-center"> <img src="{{asset('images/preloader1.gif')}}" class="img mx-auto" alt=""> </div>   
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button class="btn btn-danger" type="submit" name="delete_product_btn" >Delete</button>
          </div>
        {!! Form::close() !!} 
      </div> 
    </div>
  </div>
@endadmin
@php } @endphp



{{-- SELECT PRODUCT MODAL  --}}
@agent
<div class="modal fade" id="select_product_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" style="" role="document">

    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title" style="display:inline;font-size: 17px!important;font-weight: 400!important;"
          id="exampleModalLabel"> Are you sure the customer wants the above product? </h6>
        <button type="button" style="float:right;"  class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      {!! Form::open(['route' => ['client.select_client'], 'method'=>'get', 'files' => false, 'id'=>'product_select_form', ]) !!} 
        <div class="modal-body" id="select_ready_div">
          <div class="text-center"> <img src="{{asset('images/preloader1.gif')}}" class="img mx-auto" alt=""> </div>   
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button class="btn btn-primary" type="submit" name="update_product_btn" >Confirm</button>
        </div>
      {!! Form::close() !!} 
    </div> 
  </div>
</div>
@endagent


  <x-datatables />    {{-- datatables js scripts --}}

  <script>
    function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();    
        reader.onload = function(e) {
          $('#preview_img').attr('src', e.target.result);
        } 
        reader.readAsDataURL(input.files[0]);
      }
    } 
    $("#img_name").change(function() { readURL(this); }); 








    // FETCH SUB-CATEGORY INTO SELECT FIELD ON ADD PRODUCT FORM
    function fetch_sub_cat() {
        var main_cat_id = $('#main_category_id').val();
        var data2send={'main_cat_id':main_cat_id, 'element':'select'};  
        $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $("meta[name=csrf-token]").attr('content') }  });
        $.ajax({
            url:"{{ route('category.sub_cat_ajax_fetch') }}",
            dataType:"text",
            method:"GET",
            data:data2send,
            success:function(resp){
                $('#sub_category_id').html(resp);
            }
	    }); 
    }




  //  SOME FREE GAP HERE PLS 




   // UPDATE PRODUCT MODAL
 function update_product_modal(product_id) {   
     $('#update_ready_div').html('<div class="text-center"> <img src=" {{ asset('images/preloader1.gif') }} " class="img mx-auto" alt=""> </div>');
        $('#update_product_modal').modal('show');  // window.stop();
        // $('#update_ready_div').html('');  
        var data2send={'product_id':product_id};  
        $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $("meta[name=csrf-token]").attr('content') }  });
        $.ajax({
            url:"{{ route('product.update_ajax_fetch') }}",
            dataType:"text",
            method:"GET",
            data:data2send,
            success:function(resp){
                $('#update_ready_div').html(resp);
            }
	    }); 
    }
 
 

     // DELETE PRODUCT MODAL
     function delete_product_modal(product_id) {
      $('#delete_ready_div').html('<div class="text-center"> <img src=" {{ asset('images/preloader1.gif') }} " class="img mx-auto" alt=""> </div>');
        $('#delete_product_modal').modal('show'); 
        $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $("meta[name=csrf-token]").attr('content') }  });

        $.ajax({
        type:'GET',
        url:"{{ route('product.show_details_ajax_fetch') }}",
        data: {"product_id":product_id },

          success:function(data) {
            $('.verify').show();
            $('#delete_ready_div').html(data);  
          }
        }); 
     }



    // SELECT PRODUCT MODAL
    function select_product_modal(product_id) {
      $('#select_ready_div').html('<div class="text-center"> <img src=" {{ asset('images/preloader1.gif') }} " class="img mx-auto" alt=""> </div>');
      $('#select_product_modal').modal('show');
      $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $("meta[name=csrf-token]").attr('content') }  });
        
        $.ajax({
        type:'GET',
        url:"{{ route('product.show_details_ajax_fetch') }}",
        data: {"product_id":product_id },

            success:function(data) {
            $('.verify').show();
            $('#select_ready_div').html(data);  
          }
        }); 
     }



   // SOME FREE GAP HERE PLS 
  


   
   // refresh product div after update 
   function refresh_product_div(product_id) {    
        var data2send={'product_id':product_id};  
        $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $("meta[name=csrf-token]").attr('content') }  });
        $.ajax({
            url:"{{ route('product.refresh_product_ajax_fetch') }}",
            dataType:"text",
            method:"GET",
            data:data2send,
            success:function(resp) {
                $('#DIV-'+product_id).html(resp);
            }
	    }); 
    }

 
       
   // refresh product div after update 
   function delete_product_div(product_id) {  $('#DIV-'+product_id).html('');  }
 








 
   

  </script>
@endsection
