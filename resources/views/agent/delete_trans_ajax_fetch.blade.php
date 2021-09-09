{!! Form::open(['route' => ['transaction.destroy', ['transaction'=>$transaction->trans_id]], 'files' => false, 'method'=>'POST']) !!}   
<div class="modal-content"> @method('DELETE')
    <div class="modal-header">
      <h6 class="modal-title" style="display:inline;font-size: 17px!important;font-weight: 400!important;"
        id="exampleModalLabel"> Deleting transaction: <b>{{$transaction->trans_id}}</b> </h6>
      <button type="button" style="float:right;"  class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
      <div class="modal-body" >
        <div class="row ">
       
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Amount</label>
                    <input type="number" name="amount" id="amount" class="form-control" readonly value="{{$transaction->amount}}" required>
                </div>
            </div> 
            <div class="col-md-6">
               <div class="form-group">
                   <label for="">Type</label>
                   <input type="text" name="type" id="type" class="form-control" readonly value="{{$transaction->type}}" required>
               </div>
            </div>             

        </div>
      </div>
      <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> 
              <button class="btn btn-danger" type="submit" name="submit" >Confirm Delete</button>  
      </div> 
  </div>
  {!! Form::close() !!}  
 
 