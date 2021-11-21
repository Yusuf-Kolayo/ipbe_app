@extends('layouts.main')

@section('content')

 <link rel="stylesheet" href="{{ asset('dist/css/reset.css') }}">
 <link rel="stylesheet" href="{{ asset('dist/css/responsive.css') }}">

 <script src="{{asset('plugins/ckeditor_4_16_1_standard/ckeditor.js')}}"></script>
 <link rel="stylesheet" href="{{asset('plugins/ckeditor_4_16_1_standard/samples/toolbarconfigurator/lib/codemirror/neo.css')}}">
 <style>
  #main #editor { background: #FFF;  padding: .375rem .75rem; border: 1px solid #ced4da; }
 </style>
         
  
      <!-- Main content -->

   @admin 
   <section class="content">
    <div class="container-fluid">
      <div class="card card-body p-3 mb-2"><p class="mb-0"><b>{{$product->prd_name}}</b></p></div>
      <div class="row">
        <div class="col-md-4">


 

<!-- Product Image -->
<div class="card card-bordered">
    <div class="card-inner">
        <img src="{{asset('storage/uploads/products_img/'.$product->img_name)}}" alt="" class="img img-fluid" id="update_preview_img" style="height:200px;"/>
        <input type="hidden" value="{{$product->product_id}}"  name="product_id_delete_form" id="product_id_delete_form"/>  
      </div>
</div>







          {{-- <div class="card card-primary"> 
            <div class="card-body">
            <p class="mb-0 text-center"><b>::: ::: ::: ::: ::: :::</b></p>
            </div> 
          </div> --}}


          
          <div class="card card-primary"> 
            <div class="card-body">
            <p class="mb-0 text-center"> <i class="fas fa-flash"></i>Price: <b class="NPP price">{{number_format($product->price)}}</b></p>
            </div> 
          </div>
          <!-- /.card -->



        
        </div>
        <!-- /.col -->
        <div class="col-md-8">




        <div class="card card-bordered">
            <div class="card-inner">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active p-0 pb-1" data-toggle="tab" href="#details">Details</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link p-0 pb-1" data-toggle="tab" href="#purchase_sessions">Purchase Sessions</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link p-0 pb-1" data-toggle="tab" href="#manage">Manage</a>
                    </li> 
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="details">
                        <table class="table table-hover w-100">
                            <tr><td>Product ID</td>  <td><b>{{$product->product_id}}</b></td></tr>
                            <tr><td>Name</td>        <td><b>{{$product->prd_name}}</b></td></tr>
                            <tr><td>Price</td>       <td><b class="NPP"> {{number_format($product->price)}} </b></td></tr>
                            <tr><td>Description</td> <td>{!!substr($product->description,0,200)!!} ...</td></tr>
                        </table> 
                    </div>
                    <div class="tab-pane table-responsive" id="purchase_sessions">
                        <table id="t1" class="table table-bordered table-striped" style="">
                            <thead>
                            <tr>
                              <th>Session ID</th>
                              <th>Status</th>
                              <th>Product</th>
                              <th>Price</th>
                              <th>Balance</th> 
                              <th>%</th> 
                              <th>Date</th>  <th></th> 
                              <th></th> 
                            </tr>
                            </thead>
                           <tbody>
      
                                  {{-- loop out product_purchase_session here --}}                               
                              @foreach($product->product_purchase_session as $product_purchase_session)
                              @if (count($product_purchase_session->transaction)>0) 
                                  @php
                                    $percentage_bal =  round(($product_purchase_session->transaction->last()->new_bal/$product_purchase_session->product->price)*100, 1)
                                  @endphp
                              @else
                                  @php $percentage_bal=0; @endphp
                              @endif 
                              <tr>
                                <td> {{$product_purchase_session->pps_id}} </td>
                                <td> {{$product_purchase_session->status}} </td>
                                <td> {{$product_purchase_session->product->prd_name}} </td>
                                <td> {{$product_purchase_session->product->price}} </td>
                                <td>  
                                    @if ($product_purchase_session->transaction->last())
                                    {{ $product_purchase_session->transaction->last()->new_bal }}
                                    @else
                                      NULL
                                    @endif 
                                </td>
                                <td> {{$percentage_bal}}% </td>  
                                <td> {{$product_purchase_session->created_at}} </td>  
                                <td> <a href="#" onclick="select_pps_modal('{{$product_purchase_session->pps_id}}')" class="btn btn-primary btn-xs">product details</a> </td>  
                                <td> <a href="#" onclick="delete_pps_modal('{{$product_purchase_session->pps_id}}')" class="btn btn-danger btn-xs">Delete Session</a> </td>   
                              </tr>
                              @endforeach
                            </tbody> 
                          </table>
                    </div>




                    <div class="tab-pane" id="manage">
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
        </div>


 


        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>


    @else
        <section class="content">
        <div class="container-fluid">
          
        <div class="card">
          <div class="card-header">
            <p class="mb-0"><b>{{$product->prd_name}}</b></p>
          </div>
          <div class="card-body">
            <div class="row ">
              <div class="col-md-4 text-center">
                    <img src="{{asset('storage/uploads/products_img/'.$product->img_name)}}" alt="" class="img img-fluid" id="update_preview_img" style="height:200px;"/>
                    <input type="hidden" value="{{$product->product_id}}"  name="product_id_delete_form" id="product_id_delete_form"/>  
              </div>  
                  
              <div class="col-md-8">
                  <table class="table table-hover w-100">
                      <tr><td>Product ID</td>  <td><b>{{$product->product_id}}</b></td></tr>
                      <tr><td>Name</td>        <td><b>{{$product->prd_name}}</b></td></tr>
                      <tr><td>Price</td>       <td>
                                                    <p class="mb-0 price"><b id="PRC_{{$product->product_id}}">  
                                                    {{number_format($product->price)}}   </b> 
                                                    </p>
                                                </td></tr>
                      <tr><td>Description</td> <td>{!!substr($product->description, 0, 100)!!} ...</td></tr>
                  </table> 
              </div>   
          </div>
          </div>
        </div>

        <div class="card">
          <div class="card-header">
            <p class="mb-0"><b>Full Description</b></p>
          </div>
          <div class="card-body">
            <div class="row "> 
              <div class="col-md-12">
                  <div class="w-100"> {!!$product->description!!} </div>
              </div>   
          </div>
          </div>
        </div>




          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </section>
   @endadmin

  




 

   @include('components.product_ext') 

@endsection
