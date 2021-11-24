@extends('layouts.main')

@section('content')

<link rel="stylesheet" href="{{ asset('css/dist/css/reset.css') }}">
<link rel="stylesheet" href="{{ asset('css/dist/css/responsive.css') }}">

<div class="row">
    @if(Session::has('msg'))
        <div class="col-12 mb-2 text-center">
            @if(Session::get('msg') =='Target has been requested previously, and pay-back is completed')
            <p class="alert alert-danger"><i class="fas fa-exclamation-circle mr-2"></i>{{ Session::get('msg') }}</p>
            @elseif(Session::get('msg') =='Your Request has been generated successfully, Pending Approval')
            <p class="alert alert-success"><i class="fas fa-check-circle mr-2"></i></i>{{ Session::get('msg') }}</p>
            @else
            <p class="alert alert-warning"><i class="fas fa-times-circle mr-2"></i>{{ Session::get('msg') }}</p>
            @endif
        </div>
    @endif
    <div class="col-md-6">
    @if(Auth()->User()->usr_type =='usr_agent')
        <button type="button" class="btn btn-primary btn-sm mb-3" data-toggle="modal" data-target="#miniTransactionReport" id="newTransaction">REQUEST TARGET PAYBACK</button>
    @elseif(Auth()->User()->usr_type =='usr_client')
        <button type="button" class="btn btn-primary btn-sm mb-3 chkData" >REQUEST TARGET PAYBACK</button>
        <input type="hidden" name="numOrEmail" value="{{Auth()->User()->client->phone}}">
    @else
        <button type="button" class="btn btn-primary btn-sm mb-3">REQUESTED TARGET PAYBACKS</button>
    @endif
    </div>
    
</div>

<div class="d-none row text-center" id="showMsg">
    <div class="col-12 alert alert-danger alert-dismissible fade show d-none mb-1 py-1" role="alert" id="showMsg3">
        <i class="fas fa-exclamation-triangle pr-1"></i>
        <p id="showMsg4" class="d-inline-block mb-0"></p>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
    </div>
</div>


<div class="row">
    <div class="col-12 table-responsive">
        <table class="table table-hover table-bordered table-sm">
            <thead class="thead-dark">
                <?php
                    $agent_id=Auth()->User()->user_id;
                    $usr_type = Auth()->User()->usr_type;
                ?>
                <tr>
                    <th>S/N</th><th>NAME</th><th>PHONE-NO</th><th>AMOUNT-SAVED</th><th>PAYMENT-METHOD</th>
                    <th>BANK</th><th>ACCOUNT-NUMBER</th><th>ACCOUNT-NAME</th>
                    <th class="text-center" colspan="2">PROGRESS</th>@if($usr_type=='usr_admin')<th>HISTORY</th> <th>DELETE</th>@endif
                </tr>
            </thead>
            <tbody id="tbody">
                <?php $no=1;?>
                @foreach($requests as $request)
                
                @if($usr_type=='usr_admin')
                <tr>
                    <td>{{$no}}</td>
                    <td>{{ucfirst($request->target_saving->client->last_name) }}{{' '}}
                        {{ucfirst($request->target_saving->client->first_name) }}{{' '}}
                        {{ucfirst($request->target_saving->client->other_name )}}</td>
                        <td>{{$request->target_saving->client_no}}</td>
                        <td><b>N</b>{{$request->amount_saved}}</td>
                        <td>{{$request->payment_method}}</td>
                        @if($request->payment_method !=='Cash')
                        <td>{{$request->bank_name}}</td>
                        <td>{{$request->acc_no}}</td>
                        <td>{{$request->acc_name}}</td>
                        @else
                        <td>NULL</td>
                        <td>NULL</td>
                        <td>NULL</td>
                        @endif
                        <td>
                            @if($request->request_status=='Completed')
                                <button class="btn btn-sm btn-outline-success px-1 changeStatus" data-reqtarid="{{$request->target_saving_id}}">Completed</button>
                            @elseif($request->request_status=='In-progress')
                                <button class="btn btn-sm btn-outline-primary px-1 changeStatus" data-reqtarid="{{$request->target_saving_id}}">In-progress</button>
                            @else
                                <button class="btn btn-sm btn-outline-danger px-1 changeStatus" data-reqtarid="{{$request->target_saving_id}}">Pending</button>
                            @endif
                        </td>
                        <td class="px-1">
                            <button class="btn-sm btn btn-outline-warning reqHistory text-black ml-1"
                            type="button" data-reqId="{{$request->request_id}}" data-toggle="modal" data-target="#statusRequest" >Record</button>  
                        </td>
                        <td>
                            <?php 
                                $id=$request->target_saving_id; 
                                $client_id=$request->target_saving->client_id;
                            ?>
                            <a href="{{route('target_owner',['id'=>$id,'client_id'=>$client_id])}}" target="_blank"
                                class="btn btn-sm btn-block btn-dim btn-dark">i
                            </a>
                        </td>
                        <td class="text-center px-1 pt-1">
                            <button class="btn btn-sm btn-outline-danger btn-round py-1 deletTarget btn-block " data-reqid="{{$request->request_id}}"><i class="fas fa-trash-alt text-danger"></i></button>
                        </td>
                    </tr>
                @else
                    <tr>
                        <td>{{$no}}</td>
                        <td>{{ucfirst($request->target_saving->client->last_name) }}{{' '}}
                            {{ucfirst($request->target_saving->client->first_name) }}{{' '}}
                            {{ucfirst($request->target_saving->client->other_name )}}</td>
                            <td>{{$request->target_saving->client_no}}</td>
                            <td><b>N</b>{{$request->amount_saved}}</td>
                            <td>{{$request->payment_method}}</td>
                            @if($request->payment_method !=='Cash')
                            <td>{{$request->bank_name}}</td>
                            <td>{{$request->acc_no}}</td>
                            <td>{{$request->acc_name}}</td>
                            @else
                            <td>NULL</td>
                            <td>NULL</td>
                            <td>NULL</td>
                            @endif
                            @if($request->request_status=='Completed')
                            <td>
                                <p class="d-inline text-success font-weight-bold">Completed</p> 
                            </td>
                            @elseif($request->request_status=='In-progress')
                            <td>
                                <p class="d-inline text-primary font-weight-bold">In-progress</p> 
                            </td>
                            @else
                            <td>
                                <p class="d-inline text-danger font-weight-bold">Pending</p> 
                            </td>
                            @endif
                            <td> 
                                <button class="btn-sm btn btn-outline-warning ml-2 py-0 reqHistory"
                                type="button" data-reqId="{{$request->request_id}}" data-toggle="modal" data-target="#statusRequest" >i</button>
                            </td>
                    </tr>
                @endif
                <?php $no++?>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

  
<!-- Modal to help search for client target and return with his target and transaction details -->
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
                <button type="button" class="btn btn-primary chkData" >SUBMIT</button>
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
                        <input type="radio" name="paybackMethod" id="transfer" value="transfer">
                        <label for="transfer">
                        TRANSFER
                        </label>
                    </div>
                    <div class="form-check my-2">
                        <input type="radio" name="paybackMethod" id="cash" value="cash">
                        <label for="cash">
                        CASH
                        </label>
                    </div>
                    <div class="form-check my-2">
                        <input type="radio" name="paybackMethod" id="swap" value="swap for product" required>
                        <label for="swap">
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
            <div class="modal-body card">
                <div class="row" id="transactionForm">
                    <div class="col-12">
                        <form class="form" action="{{route('requestATarget')}}" method="POST">
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
                            <div class="row form-group mb-3 mx-1">
                                <div class="col-6 text-right">
                                    <button type="button" class="btn btn-secondary btn-block" data-dismiss="modal">EXIT</button>
                                </div> 
                                <div class="col-6">
                                    <button type="submit" class="btn btn-primary btn-block" id="saveReq">SAVE</button>
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

<!-- Modal show more detail request status -->
<div class="modal fade in" id="statusRequest"  role="dialog" aria-labelledby="statusRequestLabel" aria-hidden="true" data-backdrop='static'>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                
            </div>
        </div>
    </div>
</div>

<!-- Modal for adding comment to a requested target -->
<div class="modal fade in" id="newComment" role="dialog" aria-labelledby="newComment" aria-hidden="true" data-backdrop='static'>
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <div class="row">
                    <div class="col-12 font-weight-bold text-center">
                        <p>Share your comment on this request</p>
                    </div>
                </div>
            </div>
            <div  class="modal-body ">
                <div class="row">
                    <div class="col-12">
                        <input type="text" id="comment" name="comment" class="form-control" autocomplete="off">
                    </div>
                    <div class="col-12 mt-2">
                        <div class="row">
                            <div class="col-6">
                                <button type="button" class="btn btn-sm btn-secondary btn-block" data-dismiss="modal">CLOSE</button>
                            </div>
                            <div class="col-6">
                                <button type="button" class="btn btn-sm btn-primary btn-block" id="saveComment" disabled>SAVE</button>
                            </div>
                        </div>
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
        $('.chkData').click(function(){
            let clientInfo=$(this).parents().find(':input[name=numOrEmail]').val();
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

        
        $('input[name=paybackMethod]:radio','#reqMtd').click(function(){
            $('#reqStep1').removeAttr('disabled');
            let reqMethod=$('input[name=paybackMethod]:checked','#reqMtd').val();
 
            $('#requestPayback2').on('shown.bs.modal', function () {
                $(".modal-body #refundMethod").val( reqMethod );  
                $(".modal-body #refundMethod").addClass('text-capitalize');

                if(reqMethod =='transfer'){
                    $('#bank').removeClass('d-none');
                }
                      
            });
        })

        let comment=$('input[name=comment').val();
        if(comment !=='' && comment !=='undefined'){
            $('#saveComment').removeAttr('disabled');
        }else{
            $('#saveComment').attr('disabled','disabled');
        }

        

        $('.btnEdit').click(function(){
            $('#bankName').removeAttr('readonly');
            $('#accName').removeAttr('readonly');
            $('#accNo').removeAttr('readonly');
        })

        $('.reqHistory').click(function(){
            
            let reqId=$(this).data('reqid');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content')
                    },
                url:"{{ route('request_history') }}",
                type:'POST',
                data:{'reqId': reqId},
                dataType:'text',
                success:function(success){
                    $("#statusRequest .modal-body").html(success);
                },
                error:function(error){
                    console.log(error);
                }
            })
        })

//function to show modal to change status for Admin
        $('.changeStatus').click(function(){
            let progress=$(this).html();
            let targetId=$(this).data('reqtarid');
           
            $("#miniReport").modal("show");
            $("#miniReport").on('shown.bs.modal', function () {
                let foot=$("#miniReport .modal-footer").button();
                if($('#miniReport .modal-footer .btn-outline-danger').length == 0) {
                    if(progress=='In-progress'||progress=='Completed'){
                        let okay="<button class='btn btn-sm btn-outline-danger' id='continue' data-dismiss='modal'>CONTINUE</button>";
                        $(foot).prepend(okay);
                    }
                }
                
                if(progress=='In-progress'){
                    $("#miniReport .modal-title").html("REQUEST PROGRESS : "+ progress);
                    $("#miniReport .modal-body").html('You are about to change the progress status to completed<br>Are you sure pay-back has been completed?');
                }else if(progress=='Completed'){
                        $("#miniReport .modal-title").html("REQUEST PROGRESS : "+ progress);
                        $("#miniReport .modal-body").html('This Request has been completed<br>Are you sure you want to change status back to In-progess?');
                }else{
                        $("#miniReport .modal-title").html("REQUEST PROGRESS : "+ progress);
                        $("#miniReport .modal-body").html('You just acknowledge this request, Request is now in-progress<br>Make sure to follow up !');
                        $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content')
                            },
                        url:"{{ route('change_status') }}",
                        type:'POST',
                        data:{'targetId': targetId,'progress': progress},
                        dataType:'text',
                        success:function(success){

                        },
                        error:function(error){
                            console.log(error);
                        }
                    })
                }
                
                $('#continue').click(function(){
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content')
                            },
                        url:"{{ route('change_status') }}",
                        type:'POST',
                        data:{'targetId': targetId,'progress': progress},
                        dataType:'text',
                        error:function(error){
                            console.log(error);
                        }
                    })
                })
            })
        })

        $('.deletTarget').click(function(){
            let origin   = window.location.origin;
            let reqId= $(this).data('reqid');

            Swal.fire({
                    icon: 'question',
                    title: 'Are you sure you want to delete this request?',
                    showDenyButton: true,
                    showCancelButton: true,
                    confirmButtonText: 'Delete',
                    showLoaderOnConfirm: true,
                    cancelButtonText: `Don't delete`,
                    }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                         $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content')
                            },
                            url:"{{route('delete_request') }}",
                            data:{'reqId':reqId},
                            dataType:'json',
                            type:'POST',
                            success:function(response){
                                $.ajax({
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content')
                                    },
                                    type:'POST',
                                    url:"{{route('refresh_request_div') }}",
                                    success:function(success){
                                        $('#tbody').html(success);
                                    },
                                });
                                $("#showMsg").addClass('d-none');
                                $("#showMsg3").addClass('d-none');
                                Swal.fire('Target request deleted successfully!', '', 'success')
                            },
                            error:function(error){
                                $("#showMsg").removeClass('d-none');
                                $("#showMsg3").removeClass('d-none');
                                if(error.errorMsg){
                                    $("#showMsg4").html(error.errorMsg);
                                }else{
                                    $("#showMsg4").html('Could not delete target request, if problem pesist contact your web assistance');
                                }
                            }
                        })
                    }else if (result.isCancel) {
                        Swal.fire('Target request is not deleted', '', 'error')
                    }
                })
           
        })
    })
</script>
@endsection