@extends('layouts.main')

@section('content')
<link rel="stylesheet" href="{{ asset('css/dist/css/reset.css') }}">
<link rel="stylesheet" href="{{ asset('css/dist/css/responsive.css') }}">
<style>
    input.inp_decl { display: inline-block!important;  height: 21px;  width: 250px; font-size: 13px; }
    p.undertaken {  text-align: center;  font-weight: 600;   border-bottom: 1px solid; margin-bottom: 22px; }
    .li_decl { font-size: 13px; }
</style>



    <!-- Content Header (Page header) -->
    <section class="content-header mb-2">
      <div class="container-fluid">
        <div class="card card-inner p-2">
          <div class="">
            @if ($user->user_id==auth()->user()->user_id)
            <h5 class="mb-0">My Profile</h5>
          @else 
            <h5 class="mb-0">Staff Profile</h5>
          @endif
          </div> 
        </div>
      </div><!-- /.container-fluid -->
    </section>
      
      
      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          
          <div class="row">
            <div class="col-md-3">
  

                    <!-- Profile Image -->
                    <div class="card card-bordered">
                      <div class="card-inner">
                          <img src="{{url('images/avatar_dummy.png')}}" alt="User profile picture" class="img img-fluid mb-2" id=""/>   

                          <p class="profile-username text-center"> {{ $user->username }} </p> 
                        </div>
                    </div>

  



<!-- With Only Header -->
<div class="card card-bordered">
    <div class="card-header border-bottom">Quick Stats</div>
    <div class="card-inner">
        <p class="card-text">... ... ...</p>
    </div>
</div>


            
            </div>
            <!-- /.col -->
            <div class="col-md-9">

 



              <div class="card card-bordered">
                <div class="card-inner">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">  <a class="nav-link active p-0 pb-1" data-toggle="tab" href="#profile_data">Profile Data </a>  </li>
                        <li class="nav-item">  <a class="nav-link p-0 pb-1" data-toggle="tab" href="#manage">Manage</a> </li> 
                        <li class="nav-item">  <a class="nav-link p-0 pb-1" data-toggle="tab" href="#access_right">Rights/Permissions</a> </li>  
                    </ul>


                    <div class="tab-content">
                        <div class="tab-pane active" id="profile_data">
                            <div class="row">
                                <div class="col-12"> <p class="text-center mb-2 th_head"><b>PERSONAL INFO</b></p> 
                          
                                <div class="table-responsive">
                                  <table class="table">
                                    <tbody>   
                                      <tr> <td><span class="th_span"> Agent ID</span> </td> <td> <b>  {{ $user->user_id }} </b> </td> </tr>
                                      <tr> <td><span class="th_span"> Firstname</span> </td> <td> <b>   {{ $user->staff->first_name }} </b> </td> </tr>
                                      <tr> <td><span class="th_span"> Lastname</span> </td> <td> <b>   {{ $user->staff->last_name }} </b> </td> </tr>
                                      <tr> <td><span class="th_span"> Other name</span> </td> <td> <b>   {{ $user->staff->other_name }} </b> </td> </tr>
                                      <tr> <td><span class="th_span"> Email</span> </td> <td> <b>   {{ $user->email }} </b> </td> </tr>
                                      <tr> <td><span class="th_span"> Phone number</span> </td> <td> <b>   {{ $user->staff->phone }} </b> </td> </tr>
                                      <tr> <td><span class="th_span"> Gender</span> </td> <td> <b>   {{ $user->staff->gender }} </b> </td> </tr>
                                      <tr> <td><span class="th_span"> Address</span> </td> <td> <b>   {{ $user->staff->address }} </b> </td> </tr> 
                                      <tr> <td><span class="th_span"> City</span> </td> <td> <b> {{ $user->staff->city }} </b> </td> </tr>
                                      <tr> <td><span class="th_span"> State</span> </td> <td> <b>   {{ $user->staff->state }} </b> </td> </tr>
                                      <tr> <td><span class="th_span"> Birth Date</span> </td> <td> <b>   {{ $user->staff->birth_date }} </b> </td> </tr>
                                   </tbody> 
                                  </table> 
                                </div>
                                </div>
                              </div>
                        </div>
                     
     
                        <div class="tab-pane" id="manage">
                          <div class="row">

                            <div class="col-6 p-1">  <button type="button" class="btn btn-success btn-block" style="display:inline-grid" data-toggle="modal" data-target="#update_data">
                            <span class="fas fa-edit"></span>  Update Data  </button> </div>
                            <div class="col-6 p-1">  <button type="button" class="btn btn-danger btn-block" style="display:inline-grid" data-toggle="modal" data-target="#delete_data">
                            <span class="fas fa-trash"></span> Delete Account  </button> </div>   

                         </div>
                        </div>


                        <div class="tab-pane" id="access_right"> 
                               
                                @foreach ($app_sections as $app_section)
                                  
                                  <div class="card card-bordered">
                                    <div class="card-header border-bottom">{{strtoupper($app_section[0])}}</div>
                                    <div class="card-inner">
                                        @foreach ($app_section[1] as $section) 
                                        <div class="custom-control custom-control-md custom-switch mr-3">
                                            <input type="checkbox" 
                                             @if (in_array($app_section[0].'_'.$section[0], $permitted_sections))
                                               checked  onclick="switch_permission('remove', '{{$user->user_id}}', '{{$app_section[0]}}', '{{$section[0]}}')" 
                                             @else
                                                        onclick="switch_permission('add', '{{$user->user_id}}', '{{$app_section[0]}}', '{{$section[0]}}')" 
                                             @endif 
                                             class="custom-control-input" id="{{$app_section[0].'_'.$section[0]}}"> 
                                            <label class="custom-control-label" for="{{$app_section[0].'_'.$section[0]}}">{{$section[1]}}</label>    
                                        </div> 
                                        @endforeach 
                                    </div>
                                   </div> 
                                
                                @endforeach 
                           
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

 



















 


















           {{-- UPDATE FORM --}}
     <div class="modal fade" tabindex="-1" role="dialog" id="manage_rights">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <a href="#" class="close" data-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
                <div class="modal-body modal-body-md">
                    <h4 class="title">Access Rights Control</h4>
                
                        {!! Form::open(['route' => ['staff.update', ['staff'=>$user->user_id]], 'method'=>'POST', 'files' => true]) !!}
                            <div class="row"> @method('PUT')
                                  
                                   <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="group"> Firstname  </label>
                                        <input required type="text" value="{{$user->staff->first_name}}" class="form-control" id="first_name" name="first_name">
                                      </div>
                                   </div>
        
        
                                   <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="last_name"> Lastname </label>
                                        <input required type="text" value="{{$user->staff->last_name}}" class="form-control" id="last_name" name="last_name">
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












     {{-- UPDATE FORM --}}
     <div class="modal fade" tabindex="-1" role="dialog" id="update_data">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <a href="#" class="close" data-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
                <div class="modal-body modal-body-md">
                    <h4 class="title">Update Profile</h4>
                
                        {!! Form::open(['route' => ['staff.update', ['staff'=>$user->user_id]], 'method'=>'POST', 'files' => true]) !!}
                            <div class="row"> @method('PUT')
                                  
                                   <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="group"> Firstname  </label>
                                        <input required type="text" value="{{$user->staff->first_name}}" class="form-control" id="first_name" name="first_name">
                                      </div>
                                   </div>
        
        
                                   <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="last_name"> Lastname </label>
                                        <input required type="text" value="{{$user->staff->last_name}}" class="form-control" id="last_name" name="last_name">
                                      </div>
                                   </div>  
        
          
        
                                   <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="description"> Other name </label>
                                        <input required type="text" value="{{$user->staff->other_name}}" class="form-control" id="other_name" name="other_name">
                                      </div>
                                   </div>
        
        
                                   <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="description"> Phone Number </label>
                                        <input required type="text" value="{{$user->staff->phone}}" class="form-control" id="phone" name="phone">
                                      </div>
                                   </div>
        
        
                                   <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="gender"> Gender </label>
                                        <select name="gender" id="gender" class="form-control">
                                          <option value="{{$user->staff->phone}}">{{strtoupper($user->staff->gender)}}</option>
                                          <option value="male">MALE</option> <option value="female">FEMALE</option>
                                        </select>
                                      </div>
                                   </div>
        
        
                                   <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="description"> Res. Address </label>
                                        <input required type="text" value="{{$user->staff->address}}" class="form-control" id="address" name="address">
                                      </div>
                                   </div> 
        
                                   
                                   <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="description"> City </label>
                                        <input required type="text" value="{{$user->staff->city}}" class="form-control" id="city" name="city">
                                      </div>
                                   </div> 
        
        
                                   <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="description"> State </label>
                                        <input required type="text" value="{{$user->staff->state}}" class="form-control" id="state" name="state">
                                      </div>
                                   </div> 
        
        
        
                                   
                                   <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="description"> Email address </label>
                                        <input required type="email" value="{{$user->email}}" class="form-control" id="email" name="email">
                                      </div>
                                   </div>
        
        
        
                                   <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="description"> Username </label>
                                        <input required type="text" value="{{$user->username}}" class="form-control" id="username" name="username">
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











         {{-- UPDATE FORM --}}
         <div class="modal fade" tabindex="-1" role="dialog" id="delete_data">
            <div class="modal-dialog modal-lg" role="document"> 
                <div class="modal-content">
                    <a href="#" class="close p-3" data-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
                 {!! Form::open(['route' => ['staff.destroy', ['staff'=>$user->user_id]], 'method'=>'POST']) !!}
                    
                    <div class="modal-body modal-body-md"> @method('DELETE')
                        <h6 class="title">Are you sure to delete this account and records related ?</h6>
                   
                            <div class="row">
                              {{-- <div class="col-12"> <p class="text-center mb-2 th_head"><b>PERSONAL INFO</b></p> </div> --}}
                        
                              <div class="table-responsive mt-2">
                                <table class="table">
                                  <tbody>   
                                    <tr> <td><span class="th_span"> Agent ID</span> </td> <td> <b>  {{ $user->user_id }} </b> </td> </tr>
                                    <tr> <td><span class="th_span"> Firstname</span> </td> <td> <b>   {{ $user->staff->first_name }} </b> </td> </tr>
                                    <tr> <td><span class="th_span"> Lastname</span> </td> <td> <b>   {{ $user->staff->last_name }} </b> </td> </tr>
                                    <tr> <td><span class="th_span"> Other name</span> </td> <td> <b>   {{ $user->staff->other_name }} </b> </td> </tr>
                                    <tr> <td><span class="th_span"> Email</span> </td> <td> <b>   {{ $user->email }} </b> </td> </tr>
                                    <tr> <td><span class="th_span"> Phone number</span> </td> <td> <b>   {{ $user->staff->phone }} </b> </td> </tr>
                                    <tr> <td><span class="th_span"> Gender</span> </td> <td> <b>   {{ $user->staff->gender }} </b> </td> </tr>
                                    <tr> <td><span class="th_span"> Address</span> </td> <td> <b>   {{ $user->staff->address }} </b> </td> </tr> 
                                    <tr> <td><span class="th_span"> City</span> </td> <td> <b> {{ $user->staff->city }} </b> </td> </tr>
                                    <tr> <td><span class="th_span"> State</span> </td> <td> <b>   {{ $user->staff->state }} </b> </td> </tr>
                                    <tr> <td><span class="th_span"> Birth Date</span> </td> <td> <b>   {{ $user->staff->birth_date }} </b> </td> </tr>
                                 </tbody> 
                                </table> 
                              </div>
                               
                            </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Confirm Delete</button>
                    </div>
                 {!! Form::close() !!}
                </div>
            </div>
        </div> <!-- .modal -->
    



 



 @section('page_scripts')
    <script>
      function switch_permission (action, staff_id, title, section) { 
         var action = {"action":action,"staff_id":staff_id,"title":title,"section":section}; 
           $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $("meta[name=csrf-token]").attr('content') }  });
           $.ajax({
                       type: 'POST',
                       url: "{{route('update_user_permission')}}",
                       data: action,
                       dataType: 'json', 
                       // beforeSend: function(){  
                       // },

                       success: function(response) {  console.table(response);  refresh_permissions_div(staff_id)  },
                       error: function(resp) {
                         $('#access_right').html('<br> <br> <p><center><b>could not update permissions, something went wrong ...</b><center></p>');
                        },
                       
                   }); 
      }




    // refresh permissions div after toggle 
    function refresh_permissions_div(staff_id) {    
          var data2send={'staff_id':staff_id};  
          $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $("meta[name=csrf-token]").attr('content') }  });
          $.ajax({
              url:"{{ route('refresh_permissions_ajax_fetch') }}",
              dataType:"text",
              method:"GET",
              data:data2send,
 
              success:function(resp) {
                  $('#access_right').html(resp);
              }

        }); 
      }
    </script>
 @endsection




@endsection
