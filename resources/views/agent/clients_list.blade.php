@extends('layouts.main')

@section('content')
 
@admin 
<div class="w-100 text-right mb-3" style="display: inline-block;">
 <h5 class="mb-0 float-left"> <i class="fas fa-users"></i> Clients List</h5> 
</div>
@endadmin
 
@agent
<div class="w-100 text-right mb-3">
 <h5 class="mb-0 float-left"> <i class="fas fa-users"></i> Clients Management</h5>
  <button data-toggle="collapse" data-target="#add_new" class="btn btn-primary btn-sm"> Add New </button>
</div>
@endagent

     <div class="card collapse" id="add_new">
         <div class="card-header">{{ __('Client Registry') }}</div> 
         <div class="card-body">
             

          {!! Form::open(['route' => ['client.store'], 'method'=>'POST', 'files' => true]) !!}
          <div class="row"> 
              <div class="col-md-8 mx-auto">
               
                 <div class="row">

                  <div class="col-md-6">
                      <div class="form-group">
                          <label for="fullname"> {{__('First Name')}} </label>
                          <input required type="text" class="form-control" id="first_name" name="first_name" >
                        </div>
                     </div> 

                     <div class="col-md-6">
                      <div class="form-group">
                          <label for="fullname"> {{__('Last Name')}} </label>
                          <input required type="text" class="form-control" id="last_name" name="last_name">
                        </div>
                     </div>

                     <div class="col-md-6">
                      <div class="form-group">
                          <label for="fullname"> {{__('Other Names')}}  <small>(opt)</small>  </label>
                          <input type="text" class="form-control" id="other_name" name="other_name">
                        </div>
                     </div>

                     <div class="col-md-6">
                      <div class="form-group">
                          <label for="phone"> {{__('Telephone')}} </label>
                          <input required type="text" class="form-control" id="phone" name="phone">
                        </div>
                     </div>

                     <div class="col-md-6">
                      <div class="form-group">
                          <label for="email"> {{__('Email Address')}} </label>
                          <input required type="email" class="form-control" id="email" name="email">
                        </div>
                     </div>

                     <div class="col-md-6">
                      <div class="form-group">
                          <label for="str_address"> {{__('Full Address')}} </label>
                          <input required type="text" class="form-control" id="address" name="address">
                        </div>
                     </div>


                     <div class="col-md-6">
                      <div class="form-group">
                          <label for="username"> {{__('Username')}} </label>
                          <input required type="text" class="form-control" id="username" name="username">
                      </div>
                     </div>

                     <div class="col-md-6">
                      <div class="form-group">
                          <label for="password"> {{__('Password')}} </label>
                          <input required type="password" class="form-control" id="password" name="password">
                      </div>
                     </div>

                     <div class="col-md-6">
                      <div class="form-group">
                          <label for="password"> {{__('Confirm Password')}} </label>
                          <input required type="password" class="form-control" id="password" name="confirm_password">
                      </div>
                     </div>

                     <div class="col-md-12 pt-3">
                      <div class="form-group w-50 mx-auto"> 
                          <input type="submit" class="btn btn-primary btn-block" id="submit" value="Save client" name="submit">
                      </div>
                     </div>

                 </div>
                  
              </div> 
          </div>
          {!! Form::close() !!}


         </div> 
     </div> 

        <div class="card">
            <div class="card-header">{{ __('Registered Clients') }}</div>
            <div class="card-body table-responsive"> 
                 <table id="t1" class="table table-bordered table-striped" style="width:1000px;">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Firstname</th>
                    <th>Lastname</th>
                    <th>Other_names</th>
                    <th>Telephone</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Catchment ID</th>
                    <th>LGA</th> 
                    <th>...</th> 
                  </tr>
                  </thead>
                 <tbody>
                        {{-- loop out clients here --}}
                
                 @foreach($clients as $client)
                 <tr>
                  <td> {{$client->client_id}} </td>
                  <td> {{$client->first_name}} </td>
                  <td> {{$client->last_name}} </td>
                  <td> {{$client->other_name}} </td>
                  <td> {{$client->phone}} </td>
                  <td> {{$client->user->email}} </td>
                  <td> {{$client->address}} </td>
                  <td> {{$client->agent->catchment->catchment_id}} </td>
                  <td> {{$client->agent->catchment->lga}} </td>  
                  <td>  <a class="btn btn-primary btn-xs" href="{{ route('client.show', ['client'=>$client->client_id]) }}"> <span class="fa fa-user"></span> Profile</a> </td>
                 </tr>
                @endforeach
                  </tbody>
                  <tfoot>
                  <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th> 
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th> 
                    <th></th> 
                  </tr>
                  </tfoot>
                </table>


            </div>
        </div>
 

   
    <x-datatables />    {{-- datatables js scripts --}}
@endsection
