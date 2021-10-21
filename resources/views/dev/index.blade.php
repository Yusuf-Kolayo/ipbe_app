@extends('layouts.dev')
 
@section('content')
 
         <div class="row">

           



             <div class="col-8 mx-auto">
               

               <x-alerts />

                <div class="card mt-4" id="add_new" >
                    <div class="card-header"> <h6 class="mb-0">DEV OPTIONS</h6> </div>
        
                    <div class="card-body">
                         
                               <div class="row"> 
        
                                        <div class="col-md-4">
                                            <button type="submit" class="btn btn-primary btn-block" data-toggle="modal" data-target="#register_an_admin">Register Super Admin</button>
                                        </div>
        

                                        <div class="col-md-4">
                                                <button type="submit" class="btn btn-primary btn-block" data-toggle="modal" data-target="#update_user_permission_modal">update user permissions</button>
                                        </div> 
        
                               </div> 
        
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
                
                        {!! Form::open(['route' => ['update_all_permission'], 'method'=>'POST', 'files' => true, 'autocomplete'=>'off']) !!}
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






         {{-- register_super_admin form --}}
         <div class="modal fade" tabindex="-1" role="dialog" id="register_an_admin">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                    <a href="#" class="close" data-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
                    <div class="modal-body modal-body-md">
                        <h5 class="title">Register Super Admin</h5>
                        
                            {!! Form::open(['route' => ['register_an_admin'], 'method'=>'POST', 'files' => false]) !!}
                               
                                       
                                       <div class="row border-top pt-2"> 
                          
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="pass_key"> Passkey  </label>
                                                <input required type="text" value="" class="form-control" id="pass_key" name="pass_key">
                                              </div>
                                           </div>


                                           <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="gender"> Type </label>
                                                <select name="usr_type" id="usr_type" class="form-control">
                                                  <option value="usr_admin">Ultimate</option> 
                                                  <option value="usr_super">Super</option>
                                                </select>
                                              </div>
                                           </div>
 

                                        <div class="col-md-6">
                                         <div class="form-group">
                                             <label for="group"> Firstname  </label>
                                             <input required type="text" class="form-control" id="first_name" name="first_name">
                                           </div>
                                        </div>
             
             
                                        <div class="col-md-6">
                                         <div class="form-group">
                                             <label for="last_name"> Lastname </label>
                                             <input required type="text" class="form-control" id="last_name" name="last_name">
                                           </div>
                                        </div>  
             
               
             
                                        <div class="col-md-6">
                                         <div class="form-group">
                                             <label for="description"> Other names </label>
                                             <input required type="text" class="form-control" id="other_name" name="other_name">
                                           </div>
                                        </div>
             
             
                                        <div class="col-md-6">
                                         <div class="form-group">
                                             <label for="description"> Phone Number </label>
                                             <input required type="text" class="form-control" id="phone" name="phone">
                                           </div>
                                        </div>
             
             
                                        <div class="col-md-6">
                                         <div class="form-group">
                                             <label for="gender"> Gender </label>
                                             <select name="gender" id="gender" class="form-control">
                                               <option value="male">MALE</option> <option value="female">FEMALE</option>
                                             </select>
                                           </div>
                                        </div>
             
             
                                        <div class="col-md-6">
                                         <div class="form-group">
                                             <label for="description"> Res. Address </label>
                                             <input required type="text" class="form-control" id="address" name="address">
                                           </div>
                                        </div> 
             
                                        
                                        <div class="col-md-6">
                                         <div class="form-group">
                                             <label for="description"> City </label>
                                             <input required type="text" class="form-control" id="city" name="city">
                                           </div>
                                        </div> 
             
             
                                        <div class="col-md-6">
                                         <div class="form-group">
                                             <label for="description"> State </label>
                                             <input required type="text" class="form-control" id="state" name="state">
                                           </div>
                                        </div> 
             
             
             
                                        
                                        <div class="col-md-6">
                                         <div class="form-group">
                                             <label for="description"> Email address </label>
                                             <input required type="email" class="form-control" id="email" name="email">
                                           </div>
                                        </div>
             
             
             
                                        <div class="col-md-6">
                                         <div class="form-group">
                                             <label for="description"> Username </label>
                                             <input required type="text" class="form-control" id="username" name="username">
                                           </div>
                                        </div>
             
             
                                        <div class="col-md-6">
                                         <div class="form-group">
                                             <label for="description"> Password </label>
                                             <input required type="password" class="form-control" id="password" name="password">
                                           </div>
                                        </div>
             
                                        <div class="col-md-6">
                                         <div class="form-group">
                                             <label for="description"> Confirm password </label>
                                             <input required type="password" class="form-control" id="confirm_password" name="confirm_password">
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
