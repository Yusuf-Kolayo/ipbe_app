@extends('layouts.main')

@section('content')
 
 

        <div class="card">
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

@endsection
