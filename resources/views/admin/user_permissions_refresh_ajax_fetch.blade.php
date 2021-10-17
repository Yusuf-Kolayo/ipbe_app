@foreach ($app_sections as $app_section)
                                  
<div class="card card-bordered">
  <div class="card-header border-bottom">{{strtoupper($app_section[0])}}</div>
  <div class="card-inner">
      @foreach ($app_section[1] as $section) 
      <div class="custom-control custom-control-md custom-switch mr-3">
          <input type="checkbox" 
           @if (in_array($app_section[0].'_'.$section[0], $permitted_sections))
             checked  onclick="switch_permission('remove', '{{$staff_id}}', '{{$app_section[0]}}', '{{$section[0]}}')" 
           @else
                      onclick="switch_permission('add', '{{$staff_id}}', '{{$app_section[0]}}', '{{$section[0]}}')" 
           @endif 
           class="custom-control-input" id="{{$app_section[0].'_'.$section[0]}}"> 
          <label class="custom-control-label" for="{{$app_section[0].'_'.$section[0]}}">{{$section[1]}}</label>    
      </div> 
      @endforeach 
  </div>
 </div> 

@endforeach 