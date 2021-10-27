@extends('layouts.main')

@section('content')
  

     


        <div class="card mt-4">
          <div class="card-header">{{ __('SUPER ACCESS CONTROLS') }}</div>
          <div class="card-body"> 
            <div id="access_right">  
                 {{-- @php  dd($permitted_sections);   @endphp --}}
             
                @foreach ($app_sections as $key=> $app_section)
                <div class="custom-control custom-control-md custom-switch mr-3">
                    <input type="checkbox" 
                     @if (in_array($app_section[0],  $permitted_sections))
                       checked  onclick="switch_permission('remove', '{{$app_section[0]}}')" 
                     @else
                                onclick="switch_permission('add', '{{$app_section[0]}}')" 
                     @endif 
                     class="custom-control-input" id="{{$app_section[0]}}"> 
                    <label class="custom-control-label" for="{{$app_section[0]}}">{{ucfirst($app_section[0])}}</label>    
                </div>
                @endforeach
               
            </div>
          </div>
        </div>




 


   


        
 @section('page_scripts')
 <script>
   function switch_permission (action, section) { 
      var action = {"action":action,"section":section}; 
        $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $("meta[name=csrf-token]").attr('content') }  });
        $.ajax({
                    type: 'POST',
                    url: "{{route('update_app_permissions')}}",
                    data: action,
                    dataType: 'json', 
                    // beforeSend: function(){  
                    // },

                    success: function(response) {  console.table(response);  refresh_permissions_div()  },
                    error: function(resp) {
                      $('#access_right').html('<br> <br> <p><center><b>could not update permissions, something went wrong ...</b><center></p>');
                     },
                    
                }); 
   }




 // refresh permissions div after toggle 
 function refresh_permissions_div() {    
       var data2send={};  
       $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $("meta[name=csrf-token]").attr('content') }  });
       $.ajax({
           url:"{{ route('refresh_app_permissions_ajax_fetch') }}",
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
