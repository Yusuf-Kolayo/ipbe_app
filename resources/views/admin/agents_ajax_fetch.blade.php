<div class="card">
    <div class="card-header"><b>{{ __('Registered Agents') }}</b></div>
    <div class="card-body table-responsive"> 
         <table id="example1" class="table table-bordered table-striped" style="width:1300px;">
          <thead>
          <tr>
            <th class="all">ID</th>
            <th class="all">Firstname</th>
            <th class="all">Lastname</th>
            <th class="all">Other names</th>
            <th class="all">Gender</th>
            <th class="all">Phone number</th>
            <th class="all">Chat number</th>
            <th class="all">Email</th>
            <th class="all">Address</th>
            <th class="all">City</th>
            <th class="all">State</th> 
            <th class="all">......</th> 
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
         <td>  <a class="btn btn-primary btn-sm btn-block" href="{{ route('agent.show', ['agent'=>$agent->user->username]) }}"> <em class="icon ni ni-user-circle"></em> Profile</a> </td>
         </tr>
        @endforeach
          </tbody> 
        </table>


    </div>
</div>

<x-datatables />    {{-- datatables js scripts --}}