@extends('layouts.main')

@section('content')

<div class="d-none row text-center" id="showMsg">
    <div class="col-12 alert alert-danger alert-dismissible fade show d-none mb-1 py-1" role="alert" id="showMsg3">
        <i class="fas fa-exclamation-triangle pr-1"></i>
        <p id="showMsg4" class="d-inline-block mb-0"></p>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
    </div>
</div>
<nav class="">
    <div class=" row nav nav-tabs text-center" id="nav-tab1" role="tablist"> 
        <button class="nav-link active font-weight-bolder bg-secondary col-12 d-inline-block" id="nav-daily-tab" data-toggle="tab" data-target="#nav-daily" type="button" role="tab" aria-controls="nav-daily" aria-selected="true">TARGET TRANSACTION HISTORY</button>
    </div>
</nav>
<div class="tab-content row" id="nav-tabContent">
    <div class="tab-pane fade show active col-12 table-responsive" id="nav-daily" role="tabpanel" aria-labelledby="nav-daily-tab">
        <table class="table table-sm table-bordered mt-1">
            <thead class="table-dark">
                <tr>
                    <th>S/N</th><th>DATE</th><th>CREDITOR</th><th>METHOD</th><th>AMOUNT</th><th>EVIDENCE</th><th class="text-center">ACTION & STATUS</th>
                </tr>
            </thead>
            <tbody>
                <?php $no =1 ?>
                @foreach($pending as $pendings)
                    <tr>
                        <td>{{$no}}</td>
                        <td>{{$pendings->payment_date}}</td>
                        <td>{{ucfirst($pendings->creditor_name)}}</td>
                        <td>
                            @if($pendings->method =='cash')
                            {{ucfirst($pendings->method)}}
                            @else
                            Bank ({{ucfirst($pendings->method)}})
                            @endif
                        </td>
                        <td><b>N</b>{{$pendings->amount_paid}}</td>
                        <td>
                            @if($pendings->method =='cash' || $pendings->evidence_transfer_deposit =='')
                            NULL
                            @else
                            <a href="{{asset("transactionReciept/{$pendings->evidence_transfer_deposit}")}}" target="_blank">{{$pendings->evidence_transfer_deposit}}</a>
                            @endif
                        </td>
                        <td class="px-0">
                            @if($pendings->status=='pending')
                            <button type="button" data-id="{{$pendings->transaction_id}}" class="btn btn-danger btn-sm btn-block statusBtn" data-toggle="tooltip" data-placement="bottom" title="Transaction needs to be confirm">PENDING</button>
                            @else
                            <button type="button" data-id="{{$pendings->transaction_id}}" class="btn btn-primary btn-sm btn-block statusBtn" data-toggle="tooltip" data-placement="bottom" title="Transaction has been confirmed">APPROVED</button>
                            @endif
                        </td>
                    </tr>
                    <?php $no++?>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="8" class="text-center">
                        @if($pending->total() !==0)
                            <p class="my-0"> Showing {{$pending->firstItem()}}  -  {{$pending->lastItem()}}  &nbsp; of  &nbsp; {{$pending->total()}}</p>
                            <a class="btn btn-sm btn-dark py-0" 
                                @if($pending->previousPageUrl())
                                href="{{$pending->previousPageUrl()}}"
                                @endif
                                >
                                previous
                            </a>
                            <span class="mx-2">{{ $pending->currentPage()}}</span>
                            <a class="btn btn-sm btn-dark py-0" 
                                @if($pending->nextPageUrl())
                                href="{{$pending->nextPageUrl()}}"
                                @endif
                                >
                                Next
                            </a>
                        @else
                            <p>No pending transaction to approve</p>
                        @endif
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>




<script type="text/javascript" src="{{ URL::asset('js/jquery-3.5.1.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/popper.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/bootstrap.min.js') }}"></script>

<script type="text/javascript">
    $(document).ready(function(){
            $('.statusBtn').click(function(){
                let status=$(this).html();
                var title='Are you sure you want to approve this transaction?';
                if(status =='APPROVED'){
                    var title='Are you sure you want to DISAPPROVE this transaction?';
                }
                let pendingId=$(this).data('id');
                let no=$(this).parents('tr').children(':first-child').html();
                let tr=$(this).parents('tr');

                Swal.fire({
                    title:''+title,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#798BFF',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Approve'
                    }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content')
                                },
                            type:'post',
                            dataType:'text',
                            data:{'status':status,'id':pendingId,'no':no},
                            url:"{{ route('change_transaction_status') }}",
                            success:function(success){
                                if(success=='Network error, Transaction could not be process'){
                                    $("#showMsg").removeClass('d-none');
                                    $("#showMsg3").removeClass('d-none');
                                    $("#showMsg4").html('Transaction could not be process, Try Again !');
                                }else{
                                    $(tr).html(success);
                                    if(status =='APPROVED'){
                                        Swal.fire(
                                            'DISAPPROVED!',
                                            'Transaction has been changed to pending',
                                            'success'
                                            )
                                    }else{
                                        Swal.fire(
                                            'APPROVED!',
                                            'Transaction has been approved',
                                            'success'
                                            )
                                    }
                                }
                            },
                            error:function(error){
                                $("#showMsg").removeClass('d-none');
                                $("#showMsg3").removeClass('d-none');
                                $("#showMsg4").html('Network error - Transaction could not be process, if problem pesist contact your web assistance');
                            }
                        })
                        
                    }
                })
            
        
        })
        
    })
</script>
@endsection