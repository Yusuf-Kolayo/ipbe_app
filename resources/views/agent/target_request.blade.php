@extends('layouts.main')

@section('content')

<link rel="stylesheet" href="{{ asset('css/dist/css/reset.css') }}">
<link rel="stylesheet" href="{{ asset('css/dist/css/responsive.css') }}">

<div class="row">
    @if(Session::has('msg'))
        <div class="col-12 mb-2 text-center">
            @if(Session::get('msg') =='Target has been requested previously, pay-back is in progress')
            <p class="alert alert-warning"><i class="fas fa-exclamation-circle mr-2"></i>{{ Session::get('msg') }}</p>
            @elseif(Session::get('msg') =='Your Request has been generated successfully, Pending Approval')
            <p class="alert alert-success"><i class="fas fa-check-circle mr-2"></i></i>{{ Session::get('msg') }}</p>
            @else
            <p class="alert alert-danger"><i class="fas fa-times-circle mr-2"></i>{{ Session::get('msg') }}</p>
            @endif
        </div>
    @endif
    <div class="col-md-6">
        <button type="button" class="btn btn-primary btn-sm mb-3" data-toggle="modal" data-target="#miniTransactionReport" id="newTransaction">REQUEST TARGET PAYBACK</button>
    </div>
</div>
<div class="row">
    <div class="col-12 table-responsive">
        <table class="table table-bordered table-hover table-sm">
            <thead class="thead-dark">
                <tr>
                    <th>S/N</th><th>NAME</th><th>PHONE-NO</th><th>AMOUNT-SAVED</th><th>PAYMENT-METHOD</th>
                    <th>BANK</th><th>ACCOUNT-NUMBER</th><th>ACCOUNT-NAME</th>
                    <th>REQUEST-STATUS</th>
                </tr>
            </thead>
            <tbody>
                <?php $no=1;?>
                @foreach($requests as $request)
                <tr>
                    <td>{{$no}}</td>
                    <td>{{ucfirst($request->client->last_name) }}{{' '}}
                        {{ucfirst($request->client->first_name) }}{{' '}}
                        {{ucfirst($request->client->other_name )}}</td>
                        <td>{{$request->client_no}}</td>
                        <td>{{$request->amount_saved}}</td>
                        <td>{{$request->payment_method}}</td>
                        @if($request->payment_method !=='cash')
                        <td>{{$request->bank_name}}</td>
                        <td>{{$request->acc_no}}</td>
                        <td>{{$request->acc_name}}</td>
                        @else
                        <td>NULL</td>
                        <td>NULL</td>
                        <td>NULL</td>
                        @endif
                        @if($request->request_status=='Approved')
                        <td><span class="badge badge-dot badge-success font-weight-bold">Completed</span></td>
                        @else
                        <td><span class="badge badge-dot badge-warning pl-3 font-weight-bold">Pending</span> 
                            <button class="btn-sm btn btn-outline-warning ml-2"><i class="fas fa-edit"></i></button>
                        </td>
                        @endif
                </tr>
                <tr>{{$request}}</tr>
                <?php $no++?>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

  
<!-- Modal to help search for mini transaction -->
<div class="modal fade"  id="miniTransactionReport" role="dialog" aria-labelledby="miniTransactionReportLabel" aria-hidden="true" data-backdrop='static' >
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h5 class="modal-title" id="miniTransactionReportLabel">CLIENT MINI TRANSACTION REPORT FORM</h5>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12 my-2 pr-0">
                        <p class="font-weight-bold">Provide the target owner's Phone-number or Email</p>
                    </div>
                    <div class="col-12 mb-1">
                        <input type="text" name="numOrEmail" class=" form-control form-control-sm">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">CLOSE</button>
                <button type="button" class="btn btn-primary" id="chkData">SUBMIT</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal to request target step 1  -->
<div class="modal fade" id="requestPayback" tabindex="-1" role="dialog" aria-labelledby="requestPaybackLabel" aria-hidden="true" data-backdrop='static'>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="requestPaybackLabel">SELECT PAYMENT METHOD</h5>
            </div>
            <div class="modal-body" id="reqMtd">
                <form class="form" >
                    <div class="form-check my-2">
                        <input class="form-check-input" type="radio" name="paybackMethod" id="transfer" value="transfer">
                        <label class="form-check-label" for="transfer">
                        TRANSFER
                        </label>
                    </div>
                    <div class="form-check my-2">
                        <input class="form-check-input" type="radio" name="paybackMethod" id="cash" value="cash">
                        <label class="form-check-label" for="cash">
                        CASH
                        </label>
                    </div>
                    <div class="form-check my-2">
                        <input class="form-check-input" type="radio" name="paybackMethod" id="swap" value="swap for product" required>
                        <label class="form-check-label" for="swap">
                        SWAP FOR PRODUCT
                        </label>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">CLOSE</button>
                <button type="button" class="btn btn-primary" disabled data-dismiss="modal" data-toggle="modal" id="reqStep1"data-target="#requestPayback2">NEXT</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal to request target step 2 (form)-->
<div class="modal fade" id="requestPayback2" tabindex="-1" role="dialog" aria-labelledby="requestPayback2Label" aria-hidden="true" data-backdrop='static'>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="requestPayback2Label">STEP 2 REQUEST FORM</h5>
            </div>
            <div class="modal-body">
                <div class="row" id="transactionForm">
                    <div class="col-12 mt-3">
                        <form class="form card" action="{{route('requestATarget')}}" method="POST">
                            @csrf
                            <div class="row form-group">
                                <div class="col-md-4 offset-md-7 mb-3">
                                    <div class="row">
                                        <label for="date" class="col-12">Request Date</label>
                                        <input type="hidden" name="targetId" id="targetId" class="col-12 form-control form-control-sm" required>
                                        <input type="date" id="date" name="date" class="col-12 form-control form-control-sm" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row form-group justify-content-center">
                                <div class="col-md-5 mx-md-3 mb-3">
                                    <div class="row">
                                        <label for="saved" class="col-12 mb-1">Gross Savings</label>
                                        <input type="text" id="saved" name="saved" class="col-12 form-control form-control-sm" required readonly>
                                    </div>
                                </div>                
                                <div class="col-md-5 mx-md-3 mb-3">
                                    <div class="row">
                                        <label for="refundMethod" class="col-12 mb-1">Payback Method</label>
                                        <input type="text" id="refundMethod" name="refundMethod" class="col-12 form-control form-control-sm" readonly required>
                                    </div>
                                </div>
                            </div>            
                            <div class="row form-group justify-content-center d-none" id="bank">
                                <div class="col-12 mx-md-3  text-center">
                                    <label for="bank" class="mb-2 font-weight-bold">BANK DETAILS<button type="button" class="ml-2 btn btn-sm btn-outline-light btnEdit">EDIT</button></label>
                                </div>
                                <div class="col-12">
                                    <div class="row justify-content-center">
                                        <div class="col-6 col-md-4">
                                            <div class="row">
                                                <div class="col-12">
                                                    <label for="bankName" class="my-1 pl-1">Bank</label>
                                                </div>
                                                <div class="col-12">
                                                    <input type="text" id="bankName" name="bankName" class="form-control form-control-sm" readonly required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6 col-md-4">
                                            <div class="row">
                                                <div class="col-12">
                                                    <label for="accNo" class="my-1 pl-1">Account Number</label>
                                                </div>
                                                <div class="col-12">
                                                    <input type="text" id="accNo" name="accNo" class="form-control form-control-sm" readonly required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="row ">
                                                <div class="col-12">
                                                    <label for="accName" class="my-1 pl-1">Account name</label>
                                                </div>
                                                <div class="col-12">
                                                    <input type="text" id="accName" name="accName" class="form-control form-control-sm" readonly required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <small class="text-danger pt-2 pl-1">* Please confirm the bank details before submiting request</small>
                                </div>             
                            </div>
                            <div class="row form-group">
                                <div class="col-12 text-right">
                                    <button type="button" class="btn btn-secondary mx-2" data-dismiss="modal">EXIT</button>
                                    <button type="submit" class="btn btn-primary" id="saveReq">SAVE</button>
                                </div>                
                            </div> 
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal to help search for mini transaction -->
<div class="modal fade in" id="miniReport"  role="dialog" aria-labelledby="miniReportLabel" aria-hidden="true" data-backdrop='static'>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="miniReportLabel">OVERVIEW REPORT</h5>
            </div>
            <div class="modal-body">
            
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal change request status -->
<div class="modal fade in" id="approveReq"  role="dialog" aria-labelledby="approveReqLabel" aria-hidden="true" data-backdrop='static'>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <p>Are you sure you want to set this request to be approved and paid ?</p>
            </div>
            <div class="modal-footer">
                <div class="row">
                    <div class="col-12 text-right">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">NO</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">YES</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="{{ URL::asset('js/jquery-3.5.1.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/popper.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/bootstrap.min.js') }}"></script>

<script type="text/javascript">
    $(document).ready(function(){
        $('#chkData').click(function(){
            let clientInfo=$('input[name=numOrEmail]').val();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content')
                    },
                url:"{{ route('mini_trans_report') }}",
                type:'POST',
                data:{'clientInfo': clientInfo},
                dataType:'text',
                success:function(success){
                    //$("#miniTransactionReport").modal("toggle");
                    // $('#miniReport').modal('toggle');
                    // $('#miniReport .modal-body').html(success)
                    
                    $("#miniReport .modal-body").html(success)
                    $('#miniReport').modal('show');
                },
                error:function(error){
                    console.log(error);
                }
            })
        })

        // $('#miniReport').on('hidden.bs.modal', function () {
        //     $("#miniTransactionReport").modal("toggle");
        // })
        
        $('input[name=paybackMethod]:radio','#reqMtd').click(function(){
            $('#reqStep1').removeAttr('disabled');
            let reqMethod=$('input[name=paybackMethod]:checked','#reqMtd').val();
 
            $('#requestPayback2').on('shown.bs.modal', function () {
                $(".modal-body #refundMethod").val( reqMethod );  
                $(".modal-body #refundMethod").addClass('text-capitalize');

                if(reqMethod !=='cash'){
                    $('#bank').removeClass('d-none');
                }
                      
            });
        })

        $('.btnEdit').click(function(){
            $('#bankName').removeAttr('readonly');
            $('#accName').removeAttr('readonly');
            $('#accNo').removeAttr('readonly');
        })

        $('.updateStatus').click(function(){

        })


         
        
                    
            
        

        

    })
</script>
@endsection