@extends('layouts.main')

@section('content')
  

     


        <div class="card mt-4">
          <div class="card-header">{{ __('SUPER ACCESS CONTROLS') }}</div>
          <div class="card-body"> 
             
                @foreach ($app_sections as $app_section)
                <div class="custom-control custom-control-md custom-switch mr-3">
                    <input type="checkbox" 
                     @if (in_array($app_section, $permitted_sections))
                       checked  onclick="switch_permission('remove', '{{$app_section}}')" 
                     @else
                                onclick="switch_permission('add', '{{$app_section}}')" 
                     @endif 
                     class="custom-control-input" id="{{$app_section}}"> 
                    <label class="custom-control-label" for="{{$app_section}}">{{ucfirst($app_section)}}</label>    
                </div>
                @endforeach
               

          </div>
        </div>












   




   


@endsection
