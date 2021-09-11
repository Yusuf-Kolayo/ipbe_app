<div class="card">
    <div class="card-header"><b>{{ __('Registered Agents') }}</b></div>
    <div class="card-body table-responsive"> 
         <table id="" class="table table-bordered table-striped" style="width:1200px;">
          <thead>
          <tr>
            <th>ID</th>
            <th>Firstname</th>
            <th>Lastname</th>
            <th>Other names</th>
            <th>Gender</th>
            <th>Phone number</th>
            <th>Chat number</th>
            <th>Email</th>
            <th>Address</th>
            <th>City</th>
            <th>State</th> 
            <th>......</th> 
          </tr>
          </thead>
         <tbody>
       {{-- loop out agents here --}}
        
         @foreach($agents as $agent)
         <tr>   
         <td> {{$agent->agent_id}} </td>
         <td> {{$agent->agt_first_name}} </td>
         <td> {{$agent->agt_last_name}} </td>
         <td> {{$agent->agt_other_name}} </td>
         <td> {{$agent->agt_gender}} </td>
         <td> {{$agent->agt_phone_number}} </td>
         <td> {{$agent->agt_chat_number}} </td>
         <td> {{$agent->user->email}} </td>
         <td> {{$agent->agt_res_address}} </td>
         <td> {{$agent->agt_res_city}} </td> 
         <td> {{$agent->agt_res_state}} </td>   
         <td>  <a class="btn btn-primary btn-xs btn-block" href="{{ route('agent.show', ['agent'=>$agent->user->username]) }}"> <span class="fa fa-user"></span> Profile</a> </td>
         </tr>
        @endforeach
          </tbody>
          <tfoot>
          <td>
            <th></th>  <th></th>  <th></th>
            <th></th>  <th></th> 
            <th></th> <th></th>
            <th></th> <th></th>
            <th></th>  <th></th> 
          </td>
          </tfoot>
        </table>


    </div>
</div>