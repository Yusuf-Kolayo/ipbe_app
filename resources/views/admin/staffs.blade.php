@extends('layouts.main')
 
@section('content')
 <div class="w-100 text-right mb-3">
     <h5 class="mb-0 float-left" >Staff Management</h5>
     <button data-toggle="collapse" data-target="#add_new" class="btn btn-primary btn-sm"> Add New </button>
 </div>
        <div class="card collapse" id="add_new">
            <div class="card-header"> <h6 class="mb-0">Staff Registry</h6> </div>

            <div class="card-body">
                
                {!! Form::open(['route' => ['staff.store'], 'method'=>'POST', 'files' => true]) !!}
                <div class="row"> 
                    <div class="col-md-8 mx-auto">
                     
                       <div class="row"> 
                          
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
                        
                    </div> 
                </div>
                {!! Form::close() !!}

            </div>
        </div>

     


        <div class="card">
          <div class="card-header">{{ __('Registered staffs') }}</div>
          <div class="card-body table-responsive"> 
               <table id="example1" class="table table-bordered" style="width: 1000px">
                <thead class="bg-light">
                <tr> 
                  <th>Staff ID</th>
                  <th>Fullname</th>
                  <th>Email</th> 
                  <th>Phone</th> 
                  <th>Gender</th>  
                  <th>Address</th>
                  <th>City</th> 
                  <th>State</th> 
                  <th>Username</th> <th></th>  
                </tr>
                </thead>
               <tbody>
                      {{-- loop out staffs here --}}
              
            @foreach($staffs as $staff) 
               <tr>  
                <td> {{$staff->staff_id}} </td>
                <td> {{$staff->first_name.' '.$staff->last_name.' '.$staff->other_name}} </td> 
                <td> {{$staff->user->email}} </td> 
                <td> {{$staff->phone}} </td> 
                <td> {{$staff->gender}} </td>  
                <td> {{$staff->address}} </td>  
                <td> {{$staff->city}} </td>  
                <td> {{$staff->state}} </td>  
                <td> {{$staff->user->username}} </td>  
                <td>  <a class="btn btn-primary btn-xs w-100" id="btn_update" href="{{route('staff.show', ['staff'=>$staff->staff_id])}}"> <em class="icon ni ni-user-circle-fill"></em> Profile </a> </td>
               </tr>
              @endforeach
                </tbody> 
              </table>


          </div>
      </div>


 
      {{-- <div class="modal fade" id="update_data">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            {!! Form::open(['route' => ['staff.update', ['staff' => 0]], 'files' => false, 'id'=>'update_form']) !!}
             <div class="modal-header bg-primary">  <input type="hidden" name="_method" value="PUT">
              <h4 class="modal-title"> <span class="fas fa-edit"></span> {{__('Update staff')}} </h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span> 
              </button>
            </div>
            <div class="modal-body"> 
                <div class="row"> 
                    <div class="col-md-8 mx-auto">
                     
                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="locations"> {{__('Locations')}} <small>(eg: Ikeja, Ojota)</small> </label>
                                    <input required type="text" class="form-control" id="locations" name="locations" value="{{ $staff->locations }}">
                                  </div>
                               </div> 
    
                               <div class="col-md-6">
                                <div class="form-group">
                                    <label for="staff_id"> {{__('staff ID')}} <small>(eg: IKJ/OJ)</small> </label>
                                    <input required type="text" class="form-control" id="staff_id" name="staff_id" value="{{ $staff->staff_id }}">
                                  </div> 
                               </div> 
                              
                               <div class="col-md-6">
                                <div class="form-group">
                                    <label for="group"> {{__('Group')}}  </label>
                                   <select name="group_id" id="group_id" required="" class="form-control ng-touched ng-dirty ng-valid">
                                       <option value="{{$staff->group_id}}"> {{$staff->group->group_name}} </option>
                                        @foreach ($groups as $group)
                                        <option value="{{$group->id}}">{{$group->group_name}}</option>
                                        @endforeach
                                    </select>
                                  </div>
                               </div>
    
                               <div class="col-md-6">
                                <div class="form-group">
                                    <label for="description"> {{__('Description')}}  </label>
                                    <input type="text" class="form-control" id="description" name="description" value="{{ $staff->description }}">
                                  </div>
                               </div>
    
                      
    
                           </div>
                        
                    </div> 
                </div>
            </div>
            <div class="modal-footer justify-content-between bg-light">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
             {!! Form::close() !!}
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>  --}}
      <!-- /.modal -->
  <script>
   
  </script>
  <x-datatables />    {{-- datatables js scripts --}}

@endsection
