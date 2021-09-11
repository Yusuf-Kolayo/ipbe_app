@extends('layouts.main')

@section('content')
  

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Chat Page</h1>
            </div>
            
          </div>
        </div><!-- /.container-fluid -->
      </section>
  
      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-4">
                <div class="card">
                  <div class="card-header p-2 px-3">
                    <i class="fa fa-clock-o"></i> Recent Conversations
                  </div><!-- /.card-header -->
                  <div class="card-body">
  

                    



                    <a href="#" class="dropdown-item px-1">   
                        <!-- Message Start -->
                        <div class="media">
                          <img src=" {{ asset('css/dist/img/user1-128x128.jpg') }} " alt="User Avatar" class="img-size-50 mr-3 img-circle">
                          <div class="media-body">
                            <h3 class="dropdown-item-title">
                              Brad Diesel
                             
                            </h3>
                            <p class="text-sm short_msg">Call me whenever you can...</p>
                            <p class="text-sm text-muted mb-0"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                          </div>
                        </div>
                        <!-- Message End -->
                      </a>
                      <div class="dropdown-divider"></div>
                      <a href="#" class="dropdown-item px-1">
                        <!-- Message Start -->
                        <div class="media">
                          <img src=" {{ asset('css/dist/img/user8-128x128.jpg') }}" alt="User Avatar" class="img-size-50 img-circle mr-2">
                          <div class="media-body">
                            <h3 class="dropdown-item-title">
                              John Pierce
                              
                            </h3>
                            <p class="text-sm short_msg">I got your message bro</p>
                            <p class="text-sm text-muted mb-0"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                          </div>
                        </div> 
                        <!-- Message End -->
                      </a>
                      <div class="dropdown-divider"></div>
                      <a href="#" class="dropdown-item px-1">
                        <!-- Message Start -->
                        <div class="media">
                          <img src=" {{ asset('css/dist/img/user3-128x128.jpg') }}" alt="User Avatar" class="img-size-50 img-circle mr-2">
                          <div class="media-body">
                            <h3 class="dropdown-item-title">
                              Nora Silvester
                             
                            </h3>
                            <p class="text-sm short_msg">The subject goes here</p>
                            <p class="text-sm text-muted mb-0"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                          </div>
                        </div>
                        <!-- Message End -->
                      </a>
                      <div class="dropdown-divider"></div>




  
                  </div>
                </div>
                <!-- /.card -->
              </div>
            <!-- /.col -->
            <div class="col-md-8">
              <div class="card">
                <div class="card-header p-2 px-3">
                  <i class="fas fa-comments"></i>  Active Conversation
                </div><!-- /.card-header -->
                <div class="card-body">



                </div>
              </div>
              <!-- /.card -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </section>

 
 
 

@endsection
