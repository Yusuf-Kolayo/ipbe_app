@extends('layouts.main')

@section('content')
 

        <div class="card">
            <div class="card-header">{{ __('Client Registry') }}</div>

            <div class="card-body">
                
                {!! Form::open(['route' => ['client.update', ['client' => $client->id]], 'method'=>'POST', 'files' => true]) !!}
                <div class="row"> 
                    <div class="col-md-8 mx-auto">
                     
                       <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="fullname"> {{__('First Name')}} </label>
                                <input required value="{{ $client->first_name }}" type="text" class="form-control" id="first_name" name="first_name" >
                              </div>
                           </div> 

                           <div class="col-md-6">
                            <div class="form-group">
                                <label for="last_name"> {{__('Last Name')}} </label>
                                <input required value="{{ $client->last_name }}" type="text" class="form-control" id="last_name" name="last_name">
                              </div>
                           </div>
 
                           <div class="col-md-6">
                            <div class="form-group">
                                <label for="fullname"> {{__('Other Names')}}  <small>(opt)</small>  </label>
                                <input type="text" value="{{ $client->other_name }}" class="form-control" id="other_name" name="other_name">
                              </div>
                           </div>

                           <div class="col-md-6">
                            <div class="form-group">
                                <label for="phone"> {{__('Telephone')}} </label>
                                <input required value="{{ $client->phone }}" type="text" class="form-control" id="phone" name="phone">
                              </div>
                           </div>

                           <div class="col-md-6">
                            <div class="form-group">
                                <label for="email"> {{__('Email Address')}} </label>
                                <input required value="{{ $client->email }}" type="email" class="form-control" id="email" name="email">
                              </div>
                           </div>

                           <div class="col-md-6">
                            <div class="form-group">
                                <label for="str_address"> {{__('Street Address')}} </label>
                                <input required value="{{ $client->str_address }}" type="text" class="form-control" id="str_address" name="str_address">
                              </div>
                           </div>

                           <div class="col-md-6">
                            <div class="form-group">
                                <label for="city"> {{__('Area in Community')}} </label>
                                <input required value="{{ $client->community_area }}"  type="text" class="form-control" id="community_area" name="community_area">
                            </div>
                           </div>


                           <div class="col-md-6">
                                <div class="form-group">
                                    <label for="city"> {{__('City')}} </label>
                                    <input required value="{{ $client->city }}"  type="text" class="form-control" id="city" name="city">
                                </div>
                           </div>

                           <div class="col-md-6">
                            <div class="form-group">
                                <label for="state"> {{__('State')}} </label>
                                <input required value="{{ $client->state }}" type="text" class="form-control" id="state" name="state">
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
