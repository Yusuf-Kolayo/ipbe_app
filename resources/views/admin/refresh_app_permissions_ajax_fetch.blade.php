@foreach ($app_sections as $key=> $app_section)
<div class="custom-control custom-control-md custom-switch mr-3">
    <input type="checkbox" 
     @if (in_array($app_section[0], $permitted_sections))
       checked  onclick="switch_permission('remove', '{{$app_section[0]}}')" 
     @else
                onclick="switch_permission('add', '{{$app_section[0]}}')" 
     @endif 
     class="custom-control-input" id="{{$app_section[0]}}"> 
    <label class="custom-control-label" for="{{$app_section[0]}}">{{ucfirst($app_section[0])}}</label>    
</div>
@endforeach