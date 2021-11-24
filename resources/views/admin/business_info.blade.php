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
                        <p class="mb-0"> <em class="icon ni ni-article"></em> Brand Identity  </p> 
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
          



            <div class="card mt-4" id="">
              <div class="card-header"> <h6 class="mb-0">Brand Identity</h6> </div>
                           
              <div class="card-body table-responsive">
                      <table class="table table-hover">
                             <tr> <td>Name</td> <td>{{$business_info->name}}</td> </tr>
                             <tr> <td>Logo</td> <td> <img src="{{ asset('storage/uploads/assets/'.$business_info->logo) }}" alt="" width="40%" class="img img-fluid"> </td> </tr>
                             <tr> <td>Slogan</td> <td>{{$business_info->slogan}}</td> </tr>
                      </table>
              </div> 
              </div>



              <div class="card mt-4" id="">
                <div class="card-header"> <h6 class="mb-0">Contacts</h6> </div>
                             
                <div class="card-body table-responsive">
                        <table class="table table-hover">
                               <tr> <td>Primary Email</td> <td>{{$business_info->email_a}}</td> </tr>
                               <tr> <td>Secondary Email</td> <td> {{$business_info->email_b}} </td> </tr>
                               <tr> <td>Primary Phone</td> <td>{{$business_info->phone_a}}</td> </tr>
                               <tr> <td>Secondary Phone</td> <td>{{$business_info->phone_b}}</td> </tr>
                               <tr> <td>Primary Address</td> <td>{{$business_info->address_a}}</td> </tr>
                               <tr> <td>Secondary Address</td> <td>{{$business_info->address_b}}</td> </tr>
                               <tr> <td>Facebook Link</td> <td>{{$business_info->facebook_link}}</td> </tr>
                               <tr> <td>Twitter Link</td> <td>{{$business_info->twitter_link}}</td> </tr>
                               <tr> <td>Instagram link</td> <td>{{$business_info->instagram_link}}</td> </tr>
                        </table>
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
                                    {!! Form::open(['route' => ['frontstore.business_contacts'], 'method'=>'POST', 'files' => true]) !!}
                                    <div class="modal-header">
                                      <h5 class="modal-title d-inline"> <em class="icon ni ni-call-alt"></em> Contacts </h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <div class="modal-body"> 
                                       <div class="row"> 

                                                    <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="email_a">Primary Email</label>
                                                        <input type="text" name="email_a" id="email_a" class="form-control" required>
                                                    </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                      <div class="form-group">
                                                          <label for="email_b">Secondary Email</label>
                                                          <input type="text" name="email_b" id="email_b" class="form-control" required>
                                                    </div>
                                                    </div>


                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="phone_a">Priamry Telephone </label>
                                                            <input type="text" name="phone_a" id="phone_a" class="form-control" required>
                                                        </div>
                                                    </div>    
                                                    
                                                    <div class="col-md-6">
                                                    <div class="form-group">
                                                         <label for="phone_b">Secondary Telephone</label>
                                                         <input type="text" name="phone_b" id="phone_b" class="form-control" required>
                                                    </div>
                                                   </div> 
                
                                                    <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="address_a">Primary Adrress</label>
                                                        <input type="text" name="address_a" id="address_a" class="form-control" required>
                                                    </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="address_b">Secondary Address</label>
                                                            <input type="text" name="address_b" id="address_b" class="form-control" required>
                                                        </div>
                                                    </div>


                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="act_number">Facebook Link</label>
                                                            <input type="text" name="facebook_link" id="facebook_link" class="form-control" required>
                                                        </div>
                                                        </div>
    
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="act_number">Twitter Link</label>
                                                                <input type="text" name="twitter_link" id="twitter_link" class="form-control" required>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="act_number">Instagram Link</label>
                                                                <input type="text" name="instagram_link" id="instagram_link" class="form-control" required>
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

@endsection
