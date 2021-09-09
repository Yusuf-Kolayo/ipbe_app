@extends('layouts.main')
 
@section('content')
 <div class="w-100 text-right mb-3">
     <h5 class="mb-0 float-left" >Catchment Management</h5>
     <button data-toggle="collapse" data-target="#add_new" class="btn btn-primary btn-sm"> Add New </button>
 </div>
        <div class="card collapse" id="add_new">
            <div class="card-header">{{ __('Catchment Registry') }}</div>

            <div class="card-body">
                
                {!! Form::open(['route' => ['catchment.store'], 'method'=>'POST', 'files' => true]) !!}
                <div class="row"> 
                    <div class="col-md-8 mx-auto">
                     
                       <div class="row">

                           <div class="col-md-6">
                            <div class="form-group">
                                <label for="catchment_id"> {{__('State')}} </label>
                                <select name="state" id="state" required="" onchange="load_lga();" class="form-control ng-touched ng-dirty ng-valid">
                                    <option value=""></option>
                                    @foreach ($state_datas as $state_data)
                                        <option value="{{$state_data[0]}}x-x{{$state_data[1]}}">{{$state_data[1]}}</option>
                                    @endforeach
                               </select>
                              </div> 
                           </div> 
                          
                           <div class="col-md-6">
                            <div class="form-group">
                                <label for="group"> {{__('LGA')}}  </label>
                               <select name="lga" id="lga" required="" class="form-control ng-touched ng-dirty ng-valid">
                                   <option value=""></option> 
                                </select>
                              </div>
                           </div>


                           <div class="col-md-6">
                            <div class="form-group">
                                <label for="locations"> {{__('Locations')}}  <small>(eg: Ikeja, Ojota)</small>  </label>
                                <input required type="text" class="form-control" id="locations" name="locations" >
                              </div>
                           </div>  


                           <div class="col-md-6">
                            <div class="form-group">
                                <label for="description"> {{__('Description')}}  </label>
                                <textarea class="form-control" id="description" name="description" rows="5"></textarea>
                              
                              </div>
                           </div>

                         

                           <div class="col-md-12 pt-3">
                            <div class="form-group w-50 mx-auto"> 
                                <input type="submit" class="btn btn-primary btn-block" id="submit" >  
                               </div>
                           </div>

                       </div>
                        
                    </div> 
                </div>
                {!! Form::close() !!}

            </div>
        </div>

     


        <div class="card">
          <div class="card-header">{{ __('Registered catchments') }}</div>
          <div class="card-body"> 
               <table id="example1" class="table table-bordered">
                <thead class="bg-light">
                <tr> 
                  <th>Catchment ID</th>
                  <th>Locations</th>
                  <th>LGA</th> 
                  <th>State</th> 
                  <th>Description</th>  
                  <th>...</th>
                  <th>...</th> 
                </tr>
                </thead>
               <tbody>
                      {{-- loop out catchments here --}}
              
            @foreach($catchments as $catchment) 
               <tr>  
               <td> {{$catchment->catchment_id}} </td>
               <td> {{$catchment->locations}} </td> 
               <td> {{$catchment->lga}} </td> 
               <td> {{$catchment->state_name}} </td> 
               <td> {{$catchment->description}} </td>  
                 <td>  <button class="btn btn-primary btn-xs" id="btn_update" onclick="transfer_id({{$catchment->id}})" data-toggle="modal" data-target="#update_data"> <span class="fa fa-edit"></span> Update </button> </td>
                <td>  <a class="btn btn-danger btn-xs" href="{{ route('catchment.trash', ['catchment'=>$catchment->id]) }}"> <span class="fas fa-trash"></span> Trash </a> </td>
               </tr>
              @endforeach
                </tbody>
                <tfoot>
                <td>
                  <th></th>  <th></th> 
                  <th></th>
                  <th></th> 
                  <th></th> 
                  <th></th> 
                </td>
                </tfoot>
              </table>


          </div>
      </div>


 
      {{-- <div class="modal fade" id="update_data">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            {!! Form::open(['route' => ['catchment.update', ['catchment' => 0]], 'files' => false, 'id'=>'update_form']) !!}
             <div class="modal-header bg-primary">  <input type="hidden" name="_method" value="PUT">
              <h4 class="modal-title"> <span class="fas fa-edit"></span> {{__('Update Catchment')}} </h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span> 
              </button>
            </div>
            <div class="modal-body"> 
                <div class="row"> 
                    <div class="col-md-8 mx-auto">
                     
                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="locations"> {{__('Locations')}} <small>(eg: Ikeja, Ojota)</small> </label>
                                    <input required type="text" class="form-control" id="locations" name="locations" value="{{ $catchment->locations }}">
                                  </div>
                               </div> 
    
                               <div class="col-md-6">
                                <div class="form-group">
                                    <label for="catchment_id"> {{__('Catchment ID')}} <small>(eg: IKJ/OJ)</small> </label>
                                    <input required type="text" class="form-control" id="catchment_id" name="catchment_id" value="{{ $catchment->catchment_id }}">
                                  </div> 
                               </div> 
                              
                               <div class="col-md-6">
                                <div class="form-group">
                                    <label for="group"> {{__('Group')}}  </label>
                                   <select name="group_id" id="group_id" required="" class="form-control ng-touched ng-dirty ng-valid">
                                       <option value="{{$catchment->group_id}}"> {{$catchment->group->group_name}} </option>
                                        @foreach ($groups as $group)
                                        <option value="{{$group->id}}">{{$group->group_name}}</option>
                                        @endforeach
                                    </select>
                                  </div>
                               </div>
    
                               <div class="col-md-6">
                                <div class="form-group">
                                    <label for="description"> {{__('Description')}}  </label>
                                    <input type="text" class="form-control" id="description" name="description" value="{{ $catchment->description }}">
                                  </div>
                               </div>
    
                      
    
                           </div>
                        
                    </div> 
                </div>
            </div>
            <div class="modal-footer justify-content-between bg-light">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
             {!! Form::close() !!}
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>  --}}
      <!-- /.modal -->
  <script>
      function transfer_id(id) {
        $('#update_form').attr('action','/catchment/'+id);
      } 

      function load_lga() {
        var state = $('#state').val();

        $.ajaxSetup({  headers: { 'X-CSRF-TOKEN': $("input[name=_token]").val() }  });
        $.ajax({
          // url:"product_search.php",
          //   dataType:"text",
          //   method:"GET",
          //   data:data2send,
          //   success:function(resp) { 
          //       $('#cus_table').html(resp);
          //   }
            
          type: 'get',
          url: '{{ route("catchment.ajax_fetch_lga") }}',
          data:  {'state':state},
          dataType: 'text',  
          // beforeSend: function() {  $('#form_wizard').css("opacity",".5");  },
          success:function(resp) { 
                $('#lga').html(resp);
            } 
      });

      } 
  </script>
  <x-datatables />    {{-- datatables js scripts --}}

@endsection
