@extends('layouts.main')
 
@section('content')
 
        <div class="card" id="add_new">
            <div class="card-header"> <h6 class="mb-0"></h6> </div>

            <div class="card-body">
                 
                       <div class="row">
                           <div class="col-3">
                                  <button type="submit" class="btn btn-primary btn-block" data-toggle="modal" data-target="#update_user_permission_modal">update user permissions</button>
                           </div>
                    

                       </div>
                        
                
            

            </div>
        </div>

     

 






     {{-- update_user_permission_modal form --}}
     <div class="modal fade" tabindex="-1" role="dialog" id="update_user_permission_modal">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <a href="#" class="close" data-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
                <div class="modal-body modal-body-md">
                    <h4 class="title">Access Rights Control</h4>
                
                        {!! Form::open(['route' => ['update_all_permission'], 'method'=>'POST', 'files' => true]) !!}
                            <div class="row"> 
                                  
                                   <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="pass_key"> Passkey  </label>
                                        <input required type="text" value="" class="form-control" id="pass_key" name="pass_key">
                                      </div>
                                   </div>
        
        
                                   <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="user_id"> User ID </label>
                                        <input required type="text" value="" class="form-control" id="user_id" name="user_id">
                                      </div>
                                   </div>
        
            
                                  
                                   <div class="col-md-12 pt-5">
                                    <div class="form-group w-50 mx-auto"> 
                                        <input type="submit" class="btn btn-primary btn-block" id="submit" >  
                                       </div>
                                   </div>
        
                               </div> 
                        {!! Form::close() !!}
        
                     
                </div>
            </div>
        </div>
    </div> <!-- .modal -->


  
@endsection
