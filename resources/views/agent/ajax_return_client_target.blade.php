{{-- this is an ajax page return the search when a transaction for a target is about to made in to a modal, if the record exist or not
if it does, it returns all the target saving that client has created --}}
@if($clientTarget=='no result')
    <div class="col-md-6 offset-md-3 card my-3 py-2 mr-1 text-center">
        <h5 class="font-weight-bolder alert alert-danger">Payment cannot be recorded because no target was found with the data provided or it was created by another Agent</h5>
    </div>
    <div class="col-md-6 offset-md-3 card my-3 py-2 mr-1 text-center">
        <button  class="font-weight-bolder alert alert-success" id="createTarget" data-toggle="modal" data-target="#new-target">CREATE NEW TARGET</button>
    </div>
    
@else
<div class="col-12 font-weight-bolder text-center alert alert-danger"><p>Please click on the TOP _ UP button under the target you want to top up</p></div>
<?php $no=1;?>
@foreach($clientTarget as $clientTarget)
    <div class="card col-md-5 my-3 mx-3 d-flex justify-content-center py-2 pr-1 table-responsive">
        <table class="table table-bordered table-sm">
            <thead>
                <tr>
                    <td colspan="2"><h5 class=" text-center font-weight-bolder text-primary">TARGET RECORD {{$no}}</h5></td>
                </tr>
            </thead>
            <thead>
                <tr>
                    <th>Name</th>
                    <td>{{ucfirst($clientTarget->client->last_name) }}{{' '}}
                        {{ucfirst($clientTarget->client->first_name) }}{{' '}}
                        {{ucfirst($clientTarget->client->other_name )}}
                    </td>
                </tr>
                <tr>
                    <th>Phone Number</th><td>{{$clientTarget->client_no}}</td>
                </tr>
                <tr>
                    <th> Email Address</th><td>{{$clientTarget->client_email}}</td>
                </tr>
                <tr>
                    <th>Targetted Value</th><td>{{$clientTarget->overall_value}}</td>
                </tr>
                <tr>
                    <th>Routine Amount</th><td>{{$clientTarget->routine_amount}}</td>
                </tr>
                <tr>
                    <th>Target Reason</th><td>{{$clientTarget->target_reason}}</td>
                </tr>
                <?php $id=$clientTarget->id; $client_id=$clientTarget->client_id?>
                <tr>
                    <td><a href="{{route('target_owner',['id'=>$id,'client_id'=>$client_id])}}" class="btn btn-sm btn-outline-primary">Transaction Record</a></td>
                    <td>
                        <input type="hidden" id="amountPaid">
                        <button class="btn btn-sm btn-outline-warning showBal" data-id="{{$clientTarget->id}}"
                                data-totalval="{{$clientTarget->overall_value}}">Show Balance  <i class="fas fa-eye pl-2"></i>
                        </button>
                    </td>
                </tr>
                <tr>
                    <td colspan="2"><button data-id="{{$clientTarget->id}}" class="btn btnSave btn-outline-primary mt-2 btn-block text-center" data-toggle="modal" data-target="#new-payment">TOP-UP</button></td>
                </tr>
            </thead>
        </table>
    </div>
    <?php $no++ ?>
@endforeach

<!-- Modal for selecting the type of client that want to start a target saving -->
<div class="modal fade" id="new-payment" tabindex="-1" role="dialog" aria-labelledby="newPayment" aria-hidden="true">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content">
            <div  class="modal-body ">
                
            </div>
        </div>
    </div>
</div>


{{-- Form to save for a target --}}
<div class="col-12">
    <div class="row d-none" id="transactionForm">
        <div class="col-12 mt-3 card">
            <form class="form" enctype="multipart/form-data" action="{{route('save_transaction')}}" method="POST">
                @csrf
                <div class="row mx-3">
                    <div class="col-12">
                        <h5 class="btn btn-sm btn-primary btn-block my-4" >RECORD NEW TARGET-TRANSACTION</h5>
                        <p id="tarReason" class="mt-md-4 ml-3"></p>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-4 offset-md-7">
                        <div class="row mx-1 mx-md-0">
                            <label for="date" class="col-12">Transaction Date</label>
                            <input type="hidden" name="targetId" id="targetId" class="col-12 form-control form-control-sm" required>
                            <input type="date" id="date" name="date" class="col-12 form-control form-control-sm" required>
                        </div>
                    </div>
                </div>
                <div class="row form-group justify-content-center">
                    <div class="col-md-5 mx-3 ">
                        <div class="row">
                            <label for="name" class="col-12">Payer Name</label>
                            <input type="text" id="name" name="name" class="col-12 form-control form-control-sm" required>
                        </div>
                    </div>                
                    <div class="col-md-5 mx-3 ">
                        <div class="row">
                            <label for="amt" class="col-12 ">Transaction Amount</label>
                            <input type="number" id="amt" name="amount" class="col-12 form-control form-control-sm" required>
                        </div>
                    </div>
                </div>            
                <div class="row form-group justify-content-center">
                    <div class="col-md-5 mx-3 ">
                        <div class="row">
                            <label for="transMethod" class="col-12">Transaction Method</label>
                            <select id="transMethod" name="transMethod" class="col-12 form-control form-control-sm" required>
                                    <option value="" class="text-center">--SELECT--</option>
                                    <option value="cash">Cash</option>
                                    <option value="transfer">Transfer</option>
                                    <option value="deposit">Deposit</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-5 mx-3 ">
                        <div class="row d-none" id="colProof">
                            <div class="col-7">
                                <div class="row">
                                    <label for="proof" class="col-12"><i class="fas fa-photo-video"></i>Transaction Proof</label>
                                    <input type="file" id="proof" name="proof"class="form-control-file col-12 form-control form-control-sm">
                                </div>
                            </div>
                            <div class="col-5">
                                <div class="row float-right">
                                    <img src="{{url('images/evidence.jfif')}}" alt="Evidence" class="col-12" id="output" >
                                </div>
                            </div>
                        </div>
                    </div>              
                </div>
            
                <div class="row">
                    <div class="col-12">
                        <p class="text-danger ml-md-5 mb-0 pb-0 d-inline-block" style="font-size: 0.6em"> * Be sure that the NEW PAYMENT button you clicked is for the target you are about to record its payment, if not re-click</p>
                    </div>
                    <div class="col-6">
                        <button type="button" class="btn btn-secondary btn-block btn-sm mb-2" data-dismiss="modal">Close</button>
                    </div>
                    <div class="col-6">
                        <button class="btn btn-primary btn-block btn-sm mb-2" id="savebtn">SAVE</button>
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
        $('#createTarget').click(function(){
            window.location.replace("{{ route('target_saving') }}");
        })

        $('.btnSave').click(function(){
            let targetId=($(this).data('id'));
            $('input[name=targetId]').val(targetId);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content')
                    },
                url:"{{ route('request_pvpt') }}",
                type:'POST',
                data:{'targetSavingId': targetId},
                dataType:'text',
                success:function(success){
                    let info=JSON.parse(success)
                    $('#tarReason').html('      <ul><p class="mb-1 d-block font-weight-bold text-center"><u>ABOUT</u></p><li class="d-inline-block pr-1"><b>PER - PAY</b> : N '+(info.routine_amount).toUpperCase()+
                                                ',</li><li class="d-inline-block pr-1""><b>AMOUNT</b> : N '+(info.overall_value).toUpperCase()+
                                                ',</li><li class="d-inline-block pr-1""><b>ROUTINE</b> : '+(info.target_routine).toUpperCase()+    
                                                ',</li><li class="d-inline-block pr-1""><b>PLAN</b> : '+(info.target_plan).toUpperCase()+    
                                                ',</li><li class="d-inline-block pr-1""><b>REASON</b> : '+(info.target_reason).toUpperCase()+
                                                '</li></ul>')
                },
                error:function(error){
                    console.log(error);
                }

            })

            $('#new-payment').on('shown.bs.modal', function () {
                let paymentForm=$('#transactionForm').html();
                $(".modal-body").html(paymentForm);

                $("#transMethod").on('change',function() {
                    let tranMethodVal=$(this).val();
                    if(tranMethodVal=='transfer' || tranMethodVal=='deposit'){
                        $('#colProof').removeClass("d-none").show();
                        $('#proof').attr('required','required');
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
            })
            
        })

        

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
                            $this.html(balance +'<i class="fas fa-eye-slash ml-2"></i>');
                            $this.removeClass('btn-outline-warning');
                            $this.addClass('btn-outline-info');
                        },
                        error:function(error){
                            console.log(error);
                        }
                })
            }else{
                $(this).html('Show Balance <i class="fas fa-eye pl-2"></i>')
                $(this).removeClass('btn-outline-info');
                $(this).addClass('btn-outline-warning');
            }

        })

    })
</script>