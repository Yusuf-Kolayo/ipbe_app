{!! Form::open(['route' => ['transaction.update', ['transaction'=>$transaction->trans_id]], 'files' => false, 'method'=>'POST']) !!}   
<div class="modal-content"> @method('PATCH')
    <div class="modal-header">
      <h6 class="modal-title" style="display:inline;font-size: 17px!important;font-weight: 400!important;"
        id="exampleModalLabel"> Transaction Update for <b>{{$transaction->trans_id}}</b> </h6>
      <button type="button" style="float:right;"  class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
      <div class="modal-body" >
        <div class="row ">
       
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Amount</label>
                    <input type="number" name="amount" id="amount" class="form-control" value="{{$transaction->amount}}" required>
                </div>
            </div> 
            <div class="col-md-6">
               <div class="form-group">
                   <label for="">Type</label>
                   <select name="type" id="type" class="form-control" required>
                       <option value="{{$transaction->type}}">{{$transaction->type}}</option>
                       <option value="cash">CASH</option>
                       <option value="bank_deposit">BANK DEPOSIT</option>
                       <option value="mobile_transfer">MOBILE TRANSFER</option>
                       <option value="pos">POS</option>
                   </select>
               </div>
            </div>             

        </div>
      </div>
      <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> 
              <button class="btn btn-primary" type="submit" name="submit" >Submit</button>  
      </div> 
  </div>
  {!! Form::close() !!}  
 
 