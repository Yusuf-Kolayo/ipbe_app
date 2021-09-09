@if(count($errors) > 0)
@foreach($errors->all() as $error)
<div class="alert alert-fill alert-danger alert-icon">
  <i class="icon fas fa-exclamation-triangle"></i>  {{$error}}
  </div>
@endforeach
@endif

 

@if(session('success'))  
<div class="alert alert-fill alert-success alert-icon">
  <i class="icon fas fa-check"></i> {{session('success')}}
  </div> 
@endif


@if(session('error')) 
<div class="alert alert-fill alert-danger alert-icon">
  <i class="icon fas fa-exclamation-triangle"></i> {{session('error')}}
  </div> 
@endif


{{-- <div class="text-white mt-6 px-6 py-4 border-0 rounded relative mb-4 bg-green-200">
  <span class="inline-block align-middle mr-8 text-black">
     New Artiste Created!
    </span> 
</div> --}}