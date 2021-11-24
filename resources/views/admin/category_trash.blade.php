@extends('layouts.main')

@section('content')
  
        <div class="card" id="">
            <div class="card-header">{{ __('Are you sure to trash this Group ?') }}</div>

            <div class="card-body">
              <div class="row">
              <div class="col-md-8 mx-auto">
                <table class="table table-hover mb-0">
                    {{-- <tr> <th class="p_tb_th">Group Name</th> <td class="p_tb_td">{{ $group->group_name }}</td> </tr>
                    <tr> <th class="p_tb_th">Description</th> <td class="p_tb_td">{{ $group->description }}</td> </tr> 
                    <tr> <th class="p_tb_th">State</th> <td class="p_tb_td">{{ $group->state }}</td> </tr> 
                    <tr> <th class="p_tb_th">LGA</th> <td class="p_tb_td">{{ $group->lga }}</td> </tr>   --}}
                </table>
             </div>
             </div>
          </div>
       </div>


       <div class="card" id="">
        <div class="card-header">{{ __('If yes, Transfer or Delete all catchments attached to group') }}</div>

        <div class="card-body">
          <div class="row">
          <div class="col-md-8 mx-auto">
            <br>  <br>
         </div>
         </div>
      </div>
   </div>
      

 
  <x-datatables />    {{-- datatables js scripts --}}

@endsection
