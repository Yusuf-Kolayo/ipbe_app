@foreach($refreshTransactionRow as $updated)
        <td>{{$no}}</td>
        <td>{{$updated->payment_date}}</td>
        <td>{{ucfirst($updated->creditor_name)}}</td>
        <td>
            @if($updated->method =='cash')
            {{ucfirst($updated->method)}}
            @else
            Bank ({{ucfirst($updated->method)}})
            @endif
        </td>
        <td><b>N</b>{{$updated->amount_paid}}</td>
        <td>
            @if($updated->method =='cash' || $updated->evidence_transfer_deposit =='')
            NULL
            @else
            <a href="{{asset("transactionReciept/{$updated->evidence_transfer_deposit}")}}" target="_blank">{{$updated->evidence_transfer_deposit}}</a>
            @endif
        </td>
        <td  class="px-0">
            @if($updated->status=='pending')
            <button type="button" data-id="{{$updated->transaction_id}}" class="btn btn-danger btn-sm btn-block statusBtn" data-toggle="tooltip" data-placement="bottom" title="Transaction needs to be confirm">PENDING</button>
            @else
            <button type="button" data-id="{{$updated->transaction_id}}" class="btn btn-primary btn-sm btn-block statusBtn" data-toggle="tooltip" data-placement="bottom" title="Transaction has been confirmed">APPROVED</button>
            @endif
        </td>
@endforeach

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