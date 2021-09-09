@extends('layouts.main')

@section('content')
  
        <div class="card" id="">
            <div class="card-header bg-danger">{{ __('Are you sure to trash this catchment ?') }}</div>

            <div class="card-body">
              <div class="row">
              <div class="col-md-8 mx-auto">
                <table class="table mb-0">
                    <tr> <th class="p_tb_th">Catchment ID</th> <td class="p_tb_td">{{ $catchment->catchment_id }}</td> </tr>
                    <tr> <th class="p_tb_th">Description</th> <td class="p_tb_td">{{ $catchment->description }}</td> </tr> 
                    <tr> <th class="p_tb_th">State</th> <td class="p_tb_td">{{ $catchment->locations }}</td> </tr> 
                    <tr> <th class="p_tb_th">Group</th> <td class="p_tb_td">{{ $catchment->group->group_name }}</td> </tr>  
                </table>
             </div>
             </div>
          </div>
       </div>


    <div class="card" id="">
        <div class="card-header">{{ __('If yes, Transfer or Delete all agents attached to catchment') }}</div>

        <div class="card-body">
          <div class="row">
          <div class="col-md-8 mx-auto">
            <br>  <br>
         </div>
         </div>
      </div>

    </div>
      

   <div class="w-100 text-center">
    {!! Form::open(['route' => ['catchment.destroy', ['catchment' => $catchment->id]], 'files' => false]) !!}
       <input type="hidden" name="_method" value="DELETE">
       <button type="submit" class="btn btn-danger w-50"> <span class="fa fa-trash"></span> Proceed To Trash</button>
    {!! Form::close() !!}
  </div>

 
  <x-datatables />    {{-- datatables js scripts --}}

@endsection
