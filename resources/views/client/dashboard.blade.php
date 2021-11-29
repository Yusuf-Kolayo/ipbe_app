@extends('layouts.main')

@section('content')
 

        <div class="card">
            <div class="card-header">{{ __('Dashboard') }}</div>

            <div class="card-body">


                @if(session('purchase_wrong_account'))   
                <div class="alert alert-danger alert-icon">
                  <em class="icon ni ni-cross-circle"></em> <span>{!!session('purchase_wrong_account')!!}</span> <button class="close"></button>
                  <div class="row mt-1">
                    <div class="col-md-6 text-center">
                        <img src="{{asset('storage/uploads/products_img/'.$product_attp->img_name)}}" alt="" class="img img-fluid" id="update_preview_img" style="height:200px;"/>
                    </div>  
                        
                    <div class="col-md-6">
                        <table class="table table-hover w-100">
                            <tr><td>Product ID</td>  <td><b>{{$product_attp->product_id}}</b></td></tr>
                            <tr><td>Name</td>        <td><b>{{$product_attp->prd_name}}</b></td></tr>
                            <tr><td>Price</td>       <td><b>{{$product_attp->price}}</b></td></tr>
                            <tr><td>Description</td> <td><b>{!!substr($product_attp->description,0,200)!!} ...</b></td></tr>
                        </table>
                    </div>   
                  </div>
                </div> 
                @endif

  
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                {{ __('You are logged in!') }}
            </div>
        </div>

        
       

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>150</h3>

                <p>New Orders</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>53<sup style="font-size: 20px">%</sup></h3>

                <p>Bounce Rate</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>44</h3>

                <p>User Registrations</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>65</h3>

                <p>Unique Visitors</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
       
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
 
@endsection
