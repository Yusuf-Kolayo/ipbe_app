@extends('layouts.main')

@section('content')
<nav class="">
    <div class=" row nav nav-tabs text-center" id="nav-tab1" role="tablist"> 
        <button class="nav-link active font-weight-bolder bg-secondary col-6 d-inline-block" id="nav-daily-tab" data-toggle="tab" data-target="#nav-daily" type="button" role="tab" aria-controls="nav-daily" aria-selected="true">PENDING APPROVAL</button>
        <button class="nav-link font-weight-bolder bg-secondary col-6 d-inline-block" id="nav-weekly-tab" data-toggle="tab" data-target="#nav-weekly" type="button" role="tab" aria-controls="nav-weekly" aria-selected="false">APPROVED TOP-UP</button>
    </div>
</nav>


<div class="tab-content row" id="nav-tabContent">
    <div class="tab-pane fade show active col-12 table-responsive" id="nav-daily" role="tabpanel" aria-labelledby="nav-daily-tab">
        <table class="table table-sm table-borderless">
            <thead class="table-dark">
                <tr>
                    <th>S/N</th><th>DATE</th><th>CREDITOR</th><th>METHOD</th><th>AMOUNT</th><th>EVIDENCE</th><th>ACTION</th>
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
                        <td>{{$pendings->amount_paid}}</td>
                        <td>
                            @if($pendings->method =='cash')
                            NULL
                            @else
                            <a href="{{asset("transactionReciept/{$pendings->evidence_transfer_deposit}")}}" target="_blank">{{$pendings->evidence_transfer_deposit}}</a>
                            @endif
                        </td>
                        <td><button class="btn btn-sm btn-primary">Approve</button></td>
                    </tr>
                    <?php $no++?>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="6" class="text-center">
                        @if($pending->total() !==0)
                            <p class="my-0"> Showing {{$pending->firstItem()}}  -  {{$pending->lastItem()}}  &nbsp; of  &nbsp; {{$pending->total()}}</p>
                            <a class="btn btn-sm btn-dark py-0" href="{{$pending->previousPageUrl()}}">previous</a>
                            <span class="mx-2">{{ $pending->currentPage()}}</span>
                            <a class="btn btn-sm btn-dark py-0" href="{{$pending->nextPageUrl()}}">Next</a>
                        @else
                            <p>No pending transaction to approve</p>
                        @endif
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>


    <div class="tab-pane fade show col-12" id="nav-weekly" role="tabpanel" aria-labelledby="nav-weekly-tab">
        <table class="table table-sm table-borderless">
            <thead class="table-dark">
                <tr>
                    <th>S/N</th><th>DATE</th><th>CREDITOR</th><th>METHOD</th><th>AMOUNT</th><th>EVIDENCE</th><th>ACTION</th>
                </tr>
            </thead>
            <tbody>
                <?php $no =1 ?>
                @foreach($approved as $approve)
                    <tr>
                        <td>{{$no}}</td>
                        <td>{{$approve->payment_date}}</td>
                        <td>{{ucfirst($approve->creditor_name)}}</td>
                        <td>
                            @if($approve->method =='cash')
                            {{ucfirst($approve->method)}}
                            @else
                            Bank ({{ucfirst($approve->method)}})
                            @endif
                        </td>
                        <td>{{$approve->amount_paid}}</td>
                        <td>
                            @if($approve->method =='cash')
                            NULL
                            @else
                            <a href="{{asset("transactionReciept/{$approve->evidence_transfer_deposit}")}}" target="_blank">{{$approve->evidence_transfer_deposit}}</a>
                            @endif
                        </td>
                        <td><button class="btn btn-sm btn-primary">Approve</button></td>
                    </tr>
                    <?php $no++?>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="6" class="text-center">
                        @if($approved->total() !==0)
                            <p class="my-0"> Showing {{$approved->firstItem()}}  -  {{$approved->lastItem()}}  &nbsp; of  &nbsp; {{$approved->total()}}</p>
                            <a class="btn btn-sm btn-dark py-0" href="{{$approved->previousPageUrl()}}">previous</a>
                            <span class="mx-2">{{ $approved->currentPage()}}</span>
                            <a class="btn btn-sm btn-dark py-0" href="{{$approved->nextPageUrl()}}">Next</a>
                        @else
                            <p>No result to display</p>
                        @endif
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

@endsection