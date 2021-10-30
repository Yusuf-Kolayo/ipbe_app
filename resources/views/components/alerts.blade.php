@if(count($errors) > 0)
@foreach($errors->all() as $error)
<div class="alert alert-danger alert-icon alert-dismissible">
  <em class="icon ni ni-cross-circle"></em> <span>{!!session('error')!!}</span> <button class="close" data-dismiss="alert"></button>
</div> 
@endforeach
@endif

 

@if(session('success'))   
  <div class="alert alert-success alert-icon alert-dismissible">
    <em class="icon ni ni-check-circle"></em> <span> {!!session('success')!!}</span> <button class="close" data-dismiss="alert"></button>
  </div>
@endif





@if(session('error')) 
<div class="alert alert-danger alert-icon alert-dismissible">
  <em class="icon ni ni-cross-circle"></em> <span>{!!session('error')!!}</span> <button class="close" data-dismiss="alert"></button>
</div> 
@endif