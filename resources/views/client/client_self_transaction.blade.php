@extends('layouts.main')

@section('content')

<link rel="stylesheet" href="{{ asset('css/dist/css/reset.css') }}">
<link rel="stylesheet" href="{{ asset('css/dist/css/responsive.css') }}">
@if(Session::has('msg'))
<div class="row">
    <div class="col-12 card text-center">
       <h5 class="alert alert-info text-white" >{{ Session::get('msg') }}</h5>
    </div>
</div>
@endif
<div class="row">
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
                            <td colspan="2"><button data-id="{{$clientTarget->id}}" class="btn btn-sm btn-outline-primary my-1 btn-block text-center" data-toggle="modal" data-target="#new-payment">MAKE NEW PAYMENT</button></td>
                        </tr>
                    </thead>
                </table>
            </div>
            <?php $no++ ?>
        @endforeach
<!-- Modal for client to make payment directly using paystack -->
<div class="modal fade" id="new-payment" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content row">
            <div class="modal-header">
                <h5 class="modal-title d-inline-block" id="exampleModalLabel">Target Saving Payment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div  class="modal-body">
                <p>You are about top up the target for foodstuff</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btnCheckClient">PAY NOW</button> 
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="{{ URL::asset('js/jquery-3.5.1.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/popper.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/bootstrap.min.js') }}"></script>

<script type="text/javascript">
    $(document).ready(function(){
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
@endsection