@extends('layouts.main')

@section('content')
      
      
      <!-- Main content -->
      <section class="content">
        <div class="container-fluid"> 

            <div class="card card-header">
                <div class=""> 
                  <h5 class="mb-0"> <em class="icon ni ni-file-docs"></em>  Business info updates</h5> 
                </div> 
            </div>


     
           
            <div class="card mt-4" id="">
                <div class="card-header"> <h6 class="mb-0">Sections</h6> </div>
                             
                <div class="card-body">
                    <a class="btn btn-app" data-toggle="modal" data-target="#identity">
                        <p class="mb-0"> <em class="icon ni ni-article"></em> Identity  </p> 
                    </a>

                    <a class="btn btn-app" data-toggle="modal" data-target="#contacts">
                        <p class="mb-0"> <em class="icon ni ni-call-alt"></em> Contacts  </p> 
                    </a>

                    <a class="btn btn-app" data-toggle="modal" data-target="#about_us">
                        <p class="mb-0"> <em class="icon ni ni-building"></em> About Company  </p> 
                    </a>

                    <a class="btn btn-app" data-toggle="modal" data-target="#terms_of_service">
                        <p class="mb-0"> <em class="icon ni ni-tether"></em> Terms of services  </p> 
                    </a>

                    <a class="btn btn-app" data-toggle="modal" data-target="#privacy_policy">
                        <p class="mb-0"> <em class="icon ni ni-pinterest"></em> Privacy Policy  </p> 
                    </a>
                </div> 
            </div>
          
        </div><!-- /.container-fluid -->
      </section>










              <!-- IDENTITY MODAL -->
              <div class="modal fade" id="identity">
                <div class="modal-dialog">
                  <div class="modal-content">
                    {!! Form::open(['route' => ['frontstore.business_identity'], 'method'=>'POST', 'files' => true]) !!}
                    <div class="modal-header">
                      <h5 class="modal-title d-inline"> <em class="icon ni ni-article"></em> Identity</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body"> 
                     
                       <div class="row">
          
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Business Name</label>
                                            <input type="text" name="name" id="name" class="form-control" required>
                                        </div>
                                    </div>  

                                   <div class="col-md-6">
                                    <div class="form-group">
                                         <label for="logo">Logo</label>
                                         <input type="file" name="logo" id="logo" class="form-control" required>
                                    </div>
                                   </div> 

                                   <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="act_number">Motto <small>(opt)</small></label>
                                         <input type="text" name="slogan" id="slogan" class="form-control" required>
                                    </div>
                                   </div>
        
                                   
                       </div>
                     
                    </div>
                    <div class="modal-footer justify-content-between">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      <button class="btn btn-primary" type="submit" name="user_change_password" id="user_change_password">Submit</button> 
                    </div>
                    {!! Form::close() !!}
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
                </div>
              <!-- /.modal -->




                            <!-- CONTACTS MODAL -->
                            <div class="modal fade" id="contacts">
                                <div class="modal-dialog">
                                  <div class="modal-content">
                                  <form action="" method="post" autocomplete="off">
                                    <div class="modal-header">
                                      <h5 class="modal-title d-inline"> <em class="icon ni ni-call-alt"></em> Contacts </h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <div class="modal-body"> 
                                      {!! Form::open(['route' => ['frontstore.business_identity'], 'method'=>'POST', 'files' => true]) !!}
                                       <div class="row">
                          

                                                    <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="act_number">Support Email</label>
                                                        <input type="text" name="email" id="email" class="form-control" required>
                                                    </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="">Telephone A</label>
                                                            <input type="text" name="phone_a" id="phone_a" class="form-control" required>
                                                        </div>
                                                    </div>  
                                                    
                                                    <div class="col-md-6">
                                                    <div class="form-group">
                                                         <label for="logo">Telephone B</label>
                                                         <input type="text" name="phone_b" id="phone_b" class="form-control" required>
                                                    </div>
                                                   </div> 
                
                                                    <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="act_number">Adrress A</label>
                                                        <input type="text" name="address_a" id="address_a" class="form-control" required>
                                                    </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="act_number">Address B</label>
                                                            <input type="text" name="address_b" id="address_b" class="form-control" required>
                                                        </div>
                                                    </div>


                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="act_number">Facebook Link</label>
                                                            <input type="text" name="facebook" id="facebook" class="form-control" required>
                                                        </div>
                                                        </div>
    
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="act_number">Twitter Link</label>
                                                                <input type="text" name="twitter" id="twitter" class="form-control" required>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="act_number">Instagram Link</label>
                                                                <input type="text" name="instagram" id="instagram" class="form-control" required>
                                                            </div>
                                                        </div>
                        
                                                   
                                       </div>
                                      {!! Form::close() !!}
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                      <button class="btn btn-primary" type="submit" name="user_change_password" id="user_change_password">Submit</button>
                                     
                                    </div>
                                    </form>  
                                  </div>
                                  <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                                </div>
                              <!-- /.modal -->

@endsection
