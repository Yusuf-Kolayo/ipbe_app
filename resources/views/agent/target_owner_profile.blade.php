@extends('layouts.main')

@section('content')

<link rel="stylesheet" href="{{ asset('css/dist/css/reset.css') }}">
<link rel="stylesheet" href="{{ asset('css/dist/css/responsive.css') }}">
<style>
   
</style>

<div class="row">
    <div class="col-md-3">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title text-white">TARGET INFO</h3>
            </div>
            
            <div class="card-body">
                @foreach($clientInfo as $clientInfo)
                <strong><i class="fas fa-user mr-1"></i> Full Name </strong>
                <p class="text-muted  ml-1 mt-2">{{ucfirst($clientInfo->last_name)}}{{' '}}
                                        {{ucfirst($clientInfo->first_name)}}{{' '}}
                                        {{ucfirst($clientInfo->other_name)}}  </p>

                <hr> 
                <strong><i class="fas fa-phone mr-1"></i> Phone Number </strong> 
                <p class="text-muted  ml-1 mt-2">{{$clientInfo->phone}}</p>

                <hr> 
                <strong><i class="fas fa-envelope mr-1"></i> Email Address </strong> 
                <p class="text-muted  ml-1 mt-2">{{$clientInfo->user->email}}</p>

                <hr> 
                @foreach($targetDetail as $targetDetail)
                <strong><i class="fas fa-piggy-bank mr-1"></i></i> Targeted Value</strong> 
                <p class="text-muted ml-1 mt-2" id="total">NGN {{$targetDetail->overall_value}}</p>

                <hr> 
                <strong><i class="fas fa-money-bill-alt mr-1"></i></i> Amount Paid </strong> 
                <p class="text-muted ml-1 mt-2" id="totalPaid">NGN {{$totalPaid}}</p>
                <hr> 
                <strong><i class="far fa-money-bill-alt mr-1"></i> Balance </strong> 
                <p class="text-muted ml-1 mt-2" id="bal">NGN {{($targetDetail->overall_value)-($totalPaid)}} </p>
                <hr> 
                <strong><i class="far fa-calendar-alt mr-1"></i></i>Creation Date </strong> 
                <p class="text-muted ml-1 mt-2">{{ \Carbon\Carbon::parse($targetDetail->created_at)->format('d/m/Y')}}</p>
                <hr> 
                <strong><i class="fas fa-ruler mr-1"></i></i> Target Plan</strong> 
                <p class="text-muted ml-1 mt-2">{{ucfirst($targetDetail->target_plan)}} Plan</p>
                @endforeach
                @endforeach
            </div>
        </div>
    </div>
    <div class="col-md-9">
        <div class="card">
            <div class="card-header py-3">
                <div class="row d-flex justify-content-between">
                    <div class="col-md-9 pl-4">
                        <h5 class="text-muted card-title">TRANSACTION STATUS : <span id="statusVal"></span></h5>
                    </div>
                    <?php $usr_type = Auth()->User()->usr_type;?>
                    @if($usr_type !=='usr_admin')
                        <div class="col-md-3 mt-3 mt-md-0">
                            <button class="btn btn-sm btn-primary float-right px-3" id="newPayment">NEW PAYMENT</button>
                        </div>
                    @endif
                    
                </div>
            </div>

            <div class="card-body">
                <div class="active tab-pane table-responsive" id="transactions"> 
                    <table id="t1" class="table table-bordered table-striped">
                        <thead class="thead-dark">
                            <tr>
                                <th>TRN Date</th>
                                <th>Method</th>
                                <th>Evidence of Payment</th>
                                <th>Amount Paid</th>
                               
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($clientTargetTransaction as $clientTargetTransaction)
                            <tr>
                                <td>{{$clientTargetTransaction->payment_date}}</td>
                                <td>{{ucfirst($clientTargetTransaction->method)}}</td>
                                @if($clientTargetTransaction->evidence_transfer_deposit=='')
                                <td>NULL</td>
                                @else
                                <td><a href="{{ asset("transactionReciept/{$clientTargetTransaction->evidence_transfer_deposit}") }}" target="_blank">Reciept</a></td>
                                @endif
                                <td>{{$clientTargetTransaction->amount_paid}}</td>
                            </tr>
                            @endforeach
                            @if($totalPaid!==0)
                            <tr>
                                <td class="text-center font-weight-bold"colspan="3">TOTAL</td>
                                <td class=" font-weight-bold">{{$totalPaid}}</td>
                            </tr>
                            @else
                            <tr>
                                <td class="text-center font-weight-bold py-3"colspan="5"><p class="text-danger">NO PAYMENT HAS BEEN MADE SINCE TARGET CREATION</p></td>
                            </tr>
                            @endif
                        </tbody> 
                    </table>
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
        let targetVal=$('#total').html();
        let amtPaid=$('#totalPaid').html();
        let balance=$('#bal').html();

        if((targetVal==amtPaid) || (balance=='0')){
            $('#statusVal').html('PAYMENT DONE');
        }else{
            $('#statusVal').html('PAYMENT ON-GOING')
        }

        $('#newPayment').click(function(){
            $(window).attr('location',"{{route('target_transaction')}}");
        })
    })
</script>
@endsection