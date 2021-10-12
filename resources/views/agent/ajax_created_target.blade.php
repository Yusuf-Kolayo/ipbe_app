@if($clientTarget=='no result')
    <div class="col-md-6 offset-md-3 card my-3 py-2 mr-1 text-center">
        <h5 class="font-weight-bolder alert alert-danger">You cannot record payment because no Target was created with this Number or Email</h5>
    </div>
@else
<div class="col-12 font-weight-bolder text-center alert alert-danger"><p>Please click on the NEW PAYMENT button under the target you are about to record</p></div>
@foreach($clientTarget as $clientTarget)
    <div class="col-md-4 card my-3 py-2 mr-1">
        <h5 class="font-weight-bolder text-primary">Target Record</h5>
        <p><b> Name: </b>{{ucfirst($clientTarget->client->last_name) }}{{' '}}
            {{ucfirst($clientTarget->client->first_name) }}{{' '}}
            {{ucfirst($clientTarget->client->other_name )}}
        </p>
        <p><b> Phone Number: </b>{{$clientTarget->client_no}}</p>
        <p><b> Email Address: </b>{{$clientTarget->client_email}}</p>
        <p><b> Targetted Value: </b>{{$clientTarget->overall_value}}</p>
        <p><b> Routine Amount: </b>{{$clientTarget->routine_amount}}</p>
        <p><b> Target Reason: </b>{{$clientTarget->target_reason}}</p>
        <div class="row">
            <div class="col-6">
                <?php $id=$clientTarget->id; $client_id=$clientTarget->client_id?>
                <a href="{{route('target_owner',['id'=>$id,'client_id'=>$client_id])}}" class="btn btn-sm bg-none btn-outline-primary">Transaction Record</a>
            </div>
            <div class="col-6">
                <input type="hidden" id="amountPaid">
                <button class="btn btn-sm btn-outline-primary showBal" data-id="{{$clientTarget->id}}"
                    data-totalval="{{$clientTarget->overall_value}}">Show Balance  <i class="fas fa-eye pl-2"></i></button>
            </div>
        </div>
        <button data-id="{{$clientTarget->id}}" class="btn btnSave btn-outline-primary mt-2 btn-block text-center">NEW PAYMENT</button>
    </div>
@endforeach
<div class="col-12">
    <div class="row d-none" id="transactionForm">
        <div class="col-12 mt-3">
            <form class="form card" enctype="multipart/form-data" action="{{route('save_transaction')}}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-12">
                        <h5 class="mb-0 text-right btn btn-sm btn-primary mt-4 mb-4 ml-md-5" >Register New Target-Transaction</h5>
                        <p class="text-danger mb-3 mb-md-1 ml-md-5" style="font-size: 0.6em"> * Be sure that the NEW PAYMENT button you clicked is for the target you are about to record its payment, if not re-click</p>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-2 offset-md-9 mb-3">
                        <div class="row">
                            <label for="date" class="col-12">Transaction Date</label>
                            <input type="hidden" name="targetId" id="targetId" class="col-12 form-control form-control-sm" required>
                            <input type="date" id="date" name="date" class="col-12 form-control form-control-sm" required>
                        </div>
                    </div>
                </div>
                <div class="row form-group justify-content-center">
                    <div class="col-md-5 mx-md-3 mb-3">
                        <div class="row">
                            <label for="name" class="col-12 mb-1">Payer Name</label>
                            <input type="text" id="name" name="name" class="col-12 form-control form-control-sm" required>
                        </div>
                    </div>                
                    <div class="col-md-5 mx-md-3 mb-3">
                        <div class="row">
                            <label for="amt" class="col-12 mb-1">Transaction Amount</label>
                            <input type="number" id="amt" name="amount" class="col-12 form-control form-control-sm" required>
                        </div>
                    </div>
                </div>            
                <div class="row form-group justify-content-center">
                    <div class="col-md-5 mx-md-3 mb-3">
                        <div class="row">
                            <label for="transMethod" class="col-12 mb-1">Transaction Method</label>
                            <select id="transMethod" name="transMethod" class="col-12 form-control form-control-sm" required>
                                    <option value="" class="text-center">--SELECT--</option>
                                    <option value="cash">Cash</option>
                                    <option value="transfer">Transfer</option>
                                    <option value="deposit">Deposit</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-5 mx-md-3 mb-3">
                        <div class="row d-none" id="colProof">
                            <div class="col-7">
                                <div class="row">
                                    <label for="proof" class="col-12 mb-1"><i class="fas fa-photo-video"></i>Transaction Proof</label>
                                    <input type="file" id="proof" name="proof"class="form-control-file col-12 form-control form-control-sm">
                                </div>
                            </div>
                            <div class="col-5">
                                <div class="row float-right">
                                    <img alt="Evidence" class="col-12" id="output" >
                                </div>
                            </div>
                        </div>
                    </div>              
                </div>
            
                <div class="row">
                    <div class="col-12">
                        <button class="btn btn-primary btn-sm float-right mr-2 mb-2" id="savebtn">SAVE</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endif



<script type="text/javascript" src="{{ URL::asset('js/jquery-3.5.1.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/popper.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/bootstrap.min.js') }}"></script>

<script type="text/javascript">
    $(document).ready(function(){
       // $("#transactionForm *").attr("disabled", "disabled").off('click');
    
        $('.btnSave').click(function(){
            let targetId=($(this).data('id'));
            $('input[name=targetId]').val(targetId);
            $('#transactionForm').removeClass("d-none").show();
        })

        $("#transMethod").on('change',function() {
            let tranMethodVal=$(this).val();
            if(tranMethodVal!=='cash'&&tranMethodVal!==''){
                $('#colProof').removeClass("d-none").show();
            }else{
                $('#colProof').hide();
            }
        
        });

        $("#proof").change(function () {
            if (this.files && this.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#output').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            }
        });

        $(".showBal").click(function(){
            if ($(this).html() =='Show Balance <i class="fas fa-eye pl-2"></i>'){
                let targetId=$(this).data('id');
                let targetValue=$(this).data('totalval');
                let $this = $(this)
                
                $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content')
                            },
                        url:"{{ route('total_paid') }}",
                        type:'POST',
                        data:{'targetSavingId': targetId},
                        dataType:'text',
                        success:function(success){
                            let balance=targetValue-success;
                            $this.html(balance +'<i class="fas fa-eye-slash ml-2"></i>')
                        },
                        error:function(error){
                            console.log(error);
                        }
                })
            }else{
                $(this).html('Show Balance <i class="fas fa-eye pl-2"></i>')
            }

        })

    })
</script>