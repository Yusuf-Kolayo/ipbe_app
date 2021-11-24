@extends('layouts.main')

@section('content')

@if(Session::has('registered'))
  <div class="row">
    <div class="col-12 alert alert-success alert-dismissible fade show py-1 mb-2" role="alert">
        <p>
            <i class="fas fa-check pr-2"></i> {{ Session::get('registered')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
        </p>
    </div>
  </div>
@endif

<div class="row">
    <?php $usr_type = Auth()->User()->usr_type; $usr_id = Auth()->User()->user_id;?>
    @if($usr_type !=='usr_admin')
        <div class="col-md-6">
            <button type="button" class="btn btn-primary btn-sm mb-3" id="newTransaction">RECORD NEW TRANSACTION</button>
        </div>
        @if($usr_type =='usr_agent')
        <div class="col-md-6">
            <button type="button" class="btn btn-primary float-right btn-sm mb-3" data-toggle="modal" data-target="#new-target">CREATE NEW TARGET</button>
        </div>
        @endif
        @if($usr_type =='usr_client')
        <div class="col-md-6">
            <button type="button" class="btn btn-primary float-right btn-sm mb-3 searchExistingClient">CREATE NEW TARGET</button>
            <input type="hidden" id="phonenumber" name="phonenumber" value="{{Auth()->User()->client->phone}}">
        </div>
        @endif
    @endif
</div>

<div class="" id="targetform">

</div>
<div class="row mb-2">
    <div class="col-12 card text-center alert alert-danger d-none  alert-dismissible fade show" id="statusError">

    </div>
    <div class="col-12 card text-center alert alert-success d-none  alert-dismissible fade show" id="statusSuccess">

    </div>
</div>

<nav class="">
    <div class=" row nav nav-tabs text-center" id="nav-tab1" role="tablist"> 
        <button class="nav-link active font-weight-bolder bg-secondary col-6 d-inline-block" id="nav-daily-tab" data-toggle="tab" data-target="#nav-daily" type="button" role="tab" aria-controls="nav-daily" aria-selected="true">DAILY</button>
        <button class="nav-link font-weight-bolder bg-secondary col-6 d-inline-block" id="nav-weekly-tab" data-toggle="tab" data-target="#nav-weekly" type="button" role="tab" aria-controls="nav-weekly" aria-selected="false">WEEKLY</button>
    </div>
</nav>

<nav>
    <div class=" row nav nav-tabs" id="nav-tab2" role="tablist">
        <button class="nav-link active font-weight-bolder col-3 bg-secondary d-inline-block" id="nav-monthly-tab" data-toggle="tab" data-target="#nav-monthly" type="button" role="tab" aria-controls="nav-monthly" aria-selected="true">MONTHLY</button>
        <button class="nav-link font-weight-bolder col-3 bg-secondary d-inline-block" id="nav-quarterly-tab" data-toggle="tab" data-target="#nav-quarterly" type="button" role="tab" aria-controls="nav-quarterly" aria-selected="false">QUARTERLY</button>
        <button class="nav-link font-weight-bolder col-3 bg-secondary d-inline-block" id="nav-6month-tab" data-toggle="tab" data-target="#nav-6month" type="button" role="tab" aria-controls="nav-6month" aria-selected="false">6 MONTH</button>
        <button class="nav-link font-weight-bolder col-3 bg-secondary d-inline-block" id="nav-unfixed-tab" data-toggle="tab" data-target="#nav-unfixed" type="button" role="tab" aria-controls="nav-unfixed" aria-selected="false">UNFIXED</button>
    </div>
</nav>

<nav>
    <div class=" row nav nav-tabs" id="nav-tab3" role="tablist" style="display: none">
        <button class="nav-link active font-weight-bolder bg-secondary col-3 d-inline-block" id="nav-wmonthly-tab" data-toggle="tab" data-target="#nav-wmonthly" type="button" role="tab" aria-controls="nav-wmonthly" aria-selected="true">MONTHLY</button>
        <button class="nav-link font-weight-bolder bg-secondary col-3 d-inline-block" id="nav-wquarterly-tab" data-toggle="tab" data-target="#nav-wquarterly" type="button" role="tab" aria-controls="nav-wquarterly" aria-selected="false">QUARTERLY</button>
        <button class="nav-link font-weight-bolder bg-secondary  col-3 d-inline-block" id="nav-w6month-tab" data-toggle="tab" data-target="#nav-w6month" type="button" role="tab" aria-controls="nav-w6month" aria-selected="false">6 MONTH</button>
        <button class="nav-link font-weight-bolder bg-secondary col-3 d-inline-block" id="nav-wunfixed-tab" data-toggle="tab" data-target="#nav-wunfixed" type="button" role="tab" aria-controls="nav-wunfixed" aria-selected="false">UNFIXED</button>
    </div>
</nav>

<<<<<<< HEAD
<div id="first-tab">
    <div class="tab-content row" id="nav-tabContent">
        <div class="tab-pane fade show active col-12" id="nav-daily" role="tabpanel" aria-labelledby="nav-daily-tab">
            <div class="tab-content row" id="nav-tabContent">
                <div class="tab-pane fade show active col-12" id="nav-monthly" role="tabpanel" aria-labelledby="nav-monthly-tab">
                    <div class="row">
                        <div class="col-12" style="height: 100px">
                        daily monthly graph
                        </div>
                        <div class="col-12 table-responsive">
                            <table class="table table-bordered table-sm tableForeach">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>NAME</th><th>PHONE-NO</th><th>TARGET-VALUE</th><th>ROUTINE-AMOUNT</th><th>STATUS</th><th>TRANSACTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $clientData)
                                        @if($clientData->target_routine=='daily')
                                            @if($clientData->target_plan=='monthly')
                                                <tr>
                                                    <td>{{ucfirst($clientData->client->last_name)}}{{' '}}
                                                        {{ucfirst($clientData->client->first_name)}}{{' '}}
                                                        {{ucfirst($clientData->client->other_name)}}</td>
                                                    <td>{{$clientData->client->phone}}</td>
                                                    <td>{{$clientData->overall_value}}</td>
                                                    <td>{{$clientData->routine_amount}}</td>
                                                    <td>On-going</td>
                                                    <td data-id="{{$clientData->id}}">
                                                        <?php $id=$clientData->id; $client_id=$clientData->client_id?>
                                                        <a href="{{route('target_owner',['id'=>$id,'client_id'=>$client_id])}}" 
                                                            class="btn btn-sm btn-block btn-primary m-1 p-0 text-white">Transaction Record
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endif
=======

<div class="tab-content row" id="nav-tabContent">
    <div class="tab-pane fade show active col-12" id="nav-daily" role="tabpanel" aria-labelledby="nav-daily-tab">
        <div class="tab-content row" id="nav-tabContent">
            <div class="tab-pane fade show active col-12" id="nav-monthly" role="tabpanel" aria-labelledby="nav-monthly-tab">
                <div class="row ">
                    <div class="col-12" style="height: 100px">
                       daily monthly graph
                    </div>
                    <div class="col-12 table-responsive">
                        <table class="table table-hover table-bordered table-hover table-sm">
                            <thead class="thead-dark">
                                <tr>
                                    <th>NAME</th><th>PHONE-NO</th><th>TARGET-VALUE</th><th>ROUTINE-AMOUNT</th><th>STATUS</th><th>TRANSACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $clientData)
                                    @if($clientData->target_routine=='daily')
                                        @if($clientData->target_plan=='monthly')
                                            <tr>
                                                <td>{{ucfirst($clientData->client->last_name)}}{{' '}}
                                                    {{ucfirst($clientData->client->first_name)}}{{' '}}
                                                    {{ucfirst($clientData->client->other_name)}}</td>
                                                <td>{{$clientData->client->phone}}</td>
                                                <td>{{$clientData->overall_value}}</td>
                                                <td>{{$clientData->routine_amount}}</td>
                                                <td>On-going</td>
                                                <td data-id="{{$clientData->id}}">
                                                    <?php $id=$clientData->id; $client_id=$clientData->client_id?>
                                                    <a href="{{route('target_owner',['id'=>$id,'client_id'=>$client_id])}}" 
                                                        class="btn btn-sm btn-block btn-primary m-1 p-0 text-white">Transaction Record
                                                    </a>
                                                </td>
                                            </tr>
>>>>>>> bb1cfd5f5bde8093db318eb89089c0b87920f538
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
<<<<<<< HEAD
                <div class="tab-pane fade col-12" id="nav-quarterly" role="tabpanel" aria-labelledby="nav-quarterly-tab">
                    <div class="row ">
                        <div class="col-12" style="height: 100px">
                            quarterly graph
                        </div>
                        <div class="col-12 table">
                            <table class="table table-bordered table-sm tableForeach">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>NAME</th><th>PHONE-NO</th><th>TARGET-VALUE</th><th>ROUTINE-AMOUNT</th><th>STATUS</th><th>TRANSACTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $clientData)
                                        @if($clientData->target_routine=='daily')
                                            @if($clientData->target_plan=='3-months')
                                                <tr>
                                                    <td>{{ucfirst($clientData->client->last_name)}}{{' '}}
                                                        {{ucfirst($clientData->client->first_name)}}{{' '}}
                                                        {{ucfirst($clientData->client->other_name)}}</td>
                                                    <td>{{$clientData->client->phone}}</td>
                                                    <td>{{$clientData->overall_value}}</td>
                                                    <td>{{$clientData->routine_amount}}</td>
                                                    <td>On-going</td>
                                                    <td data-id="{{$clientData->id}}">
                                                        <?php $id=$clientData->id; $client_id=$clientData->client_id?>
                                                        <a href="{{route('target_owner',['id'=>$id,'client_id'=>$client_id])}}" 
                                                            class="btn btn-sm btn-block btn-primary m-1 p-0 text-white">Transaction Record
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endif
=======
            </div>
            <div class="tab-pane fade col-12" id="nav-quarterly" role="tabpanel" aria-labelledby="nav-quarterly-tab">
                <div class="row ">
                    <div class="col-12" style="height: 100px">
                        quarterly graph
                    </div>
                    <div class="col-12 table">
                        <table class="table table-hover table-bordered">
                            <thead class="thead-dark">
                                <tr>
                                    <th>NAME</th><th>PHONE-NO</th><th>TARGET-VALUE</th><th>ROUTINE-AMOUNT</th><th>STATUS</th><th>DETAILS</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $clientData)
                                    @if($clientData->target_routine=='daily')
                                        @if($clientData->target_plan=='3-months')
                                            <tr>
                                                <td>{{ucfirst($clientData->client->last_name) }}{{' '}}
                                                    {{ucfirst($clientData->client->first_name)}}{{' '}}
                                                    {{ucfirst($clientData->client->other_name)}}</td>
                                                <td>{{$clientData->client->phone}}</td>
                                                <td>{{$clientData->overall_value}}</td>
                                                <td>{{$clientData->routine_amount}}</td>
                                                <td>On-going</td>
                                                <td data-id="{{$clientData->id}}">
                                                    <?php $id=$clientData->id; $client_id=$clientData->client_id?>
                                                    <a href="{{route('target_owner',['id'=>$id,'client_id'=>$client_id])}}" 
                                                        class="btn btn-sm btn-block btn-primary m-1 p-0 text-white">Transaction Record
                                                    </a>
                                                </td>
                                            </tr>
>>>>>>> bb1cfd5f5bde8093db318eb89089c0b87920f538
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
<<<<<<< HEAD
                <div class="tab-pane fade col-12" id="nav-6month" role="tabpanel" aria-labelledby="nav-6month-tab">
                    <div class="row ">
                        <div class="col-12" style="height: 100px">
                            6month graph
                        </div>
                        <div class="col-12 table">
                            <table class="table table-bordered table-sm tableForeach">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>NAME</th><th>PHONE-NO</th><th>TARGET-VALUE</th><th>ROUTINE-AMOUNT</th><th>STATUS</th><th>TRANSACTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $clientData)
                                        @if($clientData->target_routine=='daily')
                                            @if($clientData->target_plan=='6-months')
                                                <tr>
                                                    <td>{{ucfirst($clientData->client->last_name)}}{{' '}}
                                                        {{ucfirst($clientData->client->first_name)}}{{' '}}
                                                        {{ucfirst($clientData->client->other_name)}}</td>
                                                    <td>{{$clientData->client->phone}}</td>
                                                    <td>{{$clientData->overall_value}}</td>
                                                    <td>{{$clientData->routine_amount}}</td>
                                                    <td>On-going</td>
                                                    <td data-id="{{$clientData->id}}">
                                                        <?php $id=$clientData->id; $client_id=$clientData->client_id?>
                                                        <a href="{{route('target_owner',['id'=>$id,'client_id'=>$client_id])}}" 
                                                            class="btn btn-sm btn-block btn-primary m-1 p-0 text-white">Transaction Record
                                                        </a>
                                                    </td>
                                                </tr>   
                                            @endif
=======
            </div>
            <div class="tab-pane fade col-12" id="nav-6month" role="tabpanel" aria-labelledby="nav-6month-tab">
                <div class="row ">
                    <div class="col-12" style="height: 100px">
                        6month graph
                    </div>
                    <div class="col-12 table">
                        <table class="table table-hover table-bordered">
                            <thead class="thead-dark">
                                <tr>
                                    <th>NAME</th><th>PHONE-NO</th><th>TARGET-VALUE</th><th>ROUTINE-AMOUNT</th><th>STATUS</th><th>DETAILS</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $clientData)
                                    @if($clientData->target_routine=='daily')
                                        @if($clientData->target_plan=='6-months')
                                            <tr>
                                                <td>{{ucfirst($clientData->client->last_name) }}{{' '}}
                                                    {{ucfirst($clientData->client->first_name)}}{{' '}}
                                                    {{ucfirst($clientData->client->other_name)}}</td>
                                                <td>{{$clientData->client->phone}}</td>
                                                <td>{{$clientData->overall_value}}</td>
                                                <td>On-going</td>
                                                <td>{{$clientData->routine_amount}}</td>
                                                <td data-id="{{$clientData->id}}">
                                                    <?php $id=$clientData->id; $client_id=$clientData->client_id?>
                                                    <a href="{{route('target_owner',['id'=>$id,'client_id'=>$client_id])}}" 
                                                        class="btn btn-sm btn-block btn-primary m-1 p-0 text-white">Transaction Record
                                                    </a>
                                                </td>
                                            </tr>
>>>>>>> bb1cfd5f5bde8093db318eb89089c0b87920f538
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
<<<<<<< HEAD
                <div class="tab-pane fade col-12" id="nav-unfixed" role="tabpanel" aria-labelledby="nav-unfixed-tab">
                    <div class="row ">
                        <div class="col-12" style="height: 100px">
                            unfixed graph
                        </div>
                        <div class="col-12 table">
                            <table class="table table-bordered table-sm tableForeach">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>NAME</th><th>PHONE-NO</th><th>TARGET-VALUE</th><th>ROUTINE-AMOUNT</th><th>STATUS</th><th>TRANSACTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $clientData)
                                        @if($clientData->target_routine=='daily')
                                            @if($clientData->target_plan=='not-specific')
                                                <tr>
                                                    <td>{{ucfirst($clientData->client->last_name)}}{{' '}}
                                                        {{ucfirst($clientData->client->first_name)}}{{' '}}
                                                        {{ucfirst($clientData->client->other_name)}}</td>
                                                    <td>{{$clientData->client->phone}}</td>
                                                    <td>{{$clientData->overall_value}}</td>
                                                    <td>{{$clientData->routine_amount}}</td>
                                                    <td>On-going</td>
                                                    <td data-id="{{$clientData->id}}">
                                                        <?php $id=$clientData->id; $client_id=$clientData->client_id?>
                                                        <a href="{{route('target_owner',['id'=>$id,'client_id'=>$client_id])}}" 
                                                            class="btn btn-sm btn-block btn-primary m-1 p-0 text-white">Transaction Record
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endif
=======
            </div>
            <div class="tab-pane fade col-12" id="nav-unfixed" role="tabpanel" aria-labelledby="nav-unfixed-tab">
                <div class="row ">
                    <div class="col-12" style="height: 100px">
                        unfixed graph
                    </div>
                    <div class="col-12 table">
                        <table class="table table-hover table-bordered">
                            <thead class="thead-dark">
                                <tr>
                                    <th>NAME</th><th>PHONE-NO</th><th>TARGET-VALUE</th><th>ROUTINE-AMOUNT</th><th>STATUS</th><th>DETAILS</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $clientData)
                                    @if($clientData->target_routine=='daily')
                                        @if($clientData->target_plan=='not-specific')
                                            <tr>
                                                <td>{{ucfirst($clientData->client->last_name) }}{{' '}}
                                                    {{ucfirst($clientData->client->first_name)}}{{' '}}
                                                    {{ucfirst($clientData->client->other_name)}}</td>
                                                <td>{{$clientData->client->phone}}</td>
                                                <td>{{$clientData->overall_value}}</td>
                                                <td>{{$clientData->routine_amount}}</td>
                                                <td>On-going</td>
                                                <td data-id="{{$clientData->id}}">
                                                    <?php $id=$clientData->id; $client_id=$clientData->client_id?>
                                                    <a href="{{route('target_owner',['id'=>$id,'client_id'=>$client_id])}}" 
                                                        class="btn btn-sm btn-block btn-primary m-1 p-0 text-white">Transaction Record
                                                    </a>
                                                </td>
                                            </tr>
>>>>>>> bb1cfd5f5bde8093db318eb89089c0b87920f538
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>


<<<<<<< HEAD
        <div class="tab-pane fade show col-12" id="nav-weekly" role="tabpanel" aria-labelledby="nav-weekly-tab">
            <div class="tab-content row" id="nav-tabContent3">
                <div class="tab-pane fade col-12 active show" id="nav-wmonthly" role="tabpanel" aria-labelledby="nav-wmonthly-tab">
                    <div class="row ">
                        <div class="col-12" style="height: 100px">
                            weekly monthly graph
                        </div>
                        <div class="col-12 table-responsive">
                            <table class="table table-bordered table-sm tableForeach">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>NAME</th><th>PHONE-NO</th><th>TARGET-VALUE</th><th>ROUTINE-AMOUNT</th><th>STATUS</th><th>TRANSACTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $clientData)
                                        @if($clientData->target_routine=='weekly')
                                            @if($clientData->target_plan=='monthly')
                                                <tr>
                                                    <td>{{ucfirst($clientData->client->last_name)}}{{' '}}
                                                        {{ucfirst($clientData->client->first_name)}}{{' '}}
                                                        {{ucfirst($clientData->client->other_name)}}</td>
                                                    <td>{{$clientData->client->phone}}</td>
                                                    <td>{{$clientData->overall_value}}</td>
                                                    <td>{{$clientData->routine_amount}}</td>
                                                    <td>On-going</td>
                                                    <td data-id="{{$clientData->id}}">
                                                        <?php $id=$clientData->id; $client_id=$clientData->client_id?>
                                                        <a href="{{route('target_owner',['id'=>$id,'client_id'=>$client_id])}}" 
                                                            class="btn btn-sm btn-block btn-primary m-1 p-0 text-white">Transaction Record
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endif
=======
    <div class="tab-pane fade show col-12" id="nav-weekly" role="tabpanel" aria-labelledby="nav-weekly-tab">
        <div class="tab-content row" id="nav-tabContent">
            <div class="tab-pane fade show active col-12" id="nav-wmonthly" role="tabpanel" aria-labelledby="nav-wmonthly-tab">
                <div class="row ">
                    <div class="col-12" style="height: 100px">
                        weekly monthly graph
                    </div>
                    <div class="col-12 table-responsive">
                        <table class="table table-hover table-bordered table-hover table-sm">
                            <thead class="thead-dark">
                                <tr>
                                    <th>NAME</th><th>PHONE-NO</th><th>TARGET-VALUE</th><th>ROUTINE-AMOUNT</th><th>STATUS</th><th>DETAILS</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $clientData)
                                    @if($clientData->target_routine=='weekly')
                                        @if($clientData->target_plan=='monthly')
                                            <tr>
                                                <td>{{ucfirst($clientData->client->last_name) }}{{' '}}
                                                    {{ucfirst($clientData->client->first_name)}}{{' '}}
                                                    {{ucfirst($clientData->client->other_name)}}</td>
                                                <td>{{$clientData->client->phone}}</td>
                                                <td>{{$clientData->overall_value}}</td>
                                                <td>{{$clientData->routine_amount}}</td>
                                                <td>On-going</td>
                                                <td data-id="{{$clientData->id}}">
                                                    <?php $id=$clientData->id; $client_id=$clientData->client_id?>
                                                    <a href="{{route('target_owner',['id'=>$id,'client_id'=>$client_id])}}" 
                                                        class="btn btn-sm btn-block btn-primary m-1 p-0 text-white">Transaction Record
                                                    </a>
                                                </td>
                                            </tr>
>>>>>>> bb1cfd5f5bde8093db318eb89089c0b87920f538
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
<<<<<<< HEAD
                <div class="tab-pane fade col-12" id="nav-wquarterly" role="tabpanel" aria-labelledby="nav-wquarterly-tab">
                    <div class="row ">
                        <div class="col-12" style="height: 100px">
                            quarterly graph
                        </div>
                        <div class="col-12 table">
                            <table class="table table-bordered table-sm tableForeach">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>NAME</th><th>PHONE-NO</th><th>TARGET-VALUE</th><th>ROUTINE-AMOUNT</th><th>STATUS</th><th>TRANSACTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $clientData)
                                        @if($clientData->target_routine=='weekly')
                                            @if($clientData->target_plan=='3-months')
                                                <tr>
                                                    <td>{{ucfirst($clientData->client->last_name)}}{{' '}}
                                                        {{ucfirst($clientData->client->first_name)}}{{' '}}
                                                        {{ucfirst($clientData->client->other_name)}}</td>
                                                    <td>{{$clientData->client->phone}}</td>
                                                    <td>{{$clientData->overall_value}}</td>
                                                    <td>{{$clientData->routine_amount}}</td>
                                                    <td>On-going</td>
                                                    <td data-id="{{$clientData->id}}">
                                                        <?php $id=$clientData->id; $client_id=$clientData->client_id?>
                                                        <a href="{{route('target_owner',['id'=>$id,'client_id'=>$client_id])}}" 
                                                            class="btn btn-sm btn-block btn-primary m-1 p-0 text-white">Transaction Record
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endif
=======
            </div>
            <div class="tab-pane fade col-12" id="nav-wquarterly" role="tabpanel" aria-labelledby="nav-wquarterly-tab">
                <div class="row ">
                    <div class="col-12" style="height: 100px">
                        quarterly graph
                    </div>
                    <div class="col-12 table">
                        <table class="table table-hover table-bordered">
                            <thead class="thead-dark">
                                <tr>
                                    <th>NAME</th><th>PHONE-NO</th><th>TARGET-VALUE</th><th>ROUTINE-AMOUNT</th><th>STATUS</th><th>DETAILS</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $clientData)
                                    @if($clientData->target_routine=='weekly')
                                        @if($clientData->target_plan=='3-months')
                                            <tr>
                                                <td>{{ucfirst($clientData->client->last_name) }}{{' '}}
                                                    {{ucfirst($clientData->client->first_name)}}{{' '}}
                                                    {{ucfirst($clientData->client->other_name)}}</td>
                                                <td>{{$clientData->client->phone}}</td>
                                                <td>{{$clientData->overall_value}}</td>
                                                <td>{{$clientData->routine_amount}}</td>
                                                <td>On-going</td>
                                                <td data-id="{{$clientData->id}}">
                                                    <?php $id=$clientData->id; $client_id=$clientData->client_id?>
                                                    <a href="{{route('target_owner',['id'=>$id,'client_id'=>$client_id])}}" 
                                                        class="btn btn-sm btn-block btn-primary m-1 p-0 text-white">Transaction Record
                                                    </a>
                                                </td>
                                            </tr>
>>>>>>> bb1cfd5f5bde8093db318eb89089c0b87920f538
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
<<<<<<< HEAD
                <div class="tab-pane fade col-12" id="nav-w6month" role="tabpanel" aria-labelledby="nav-w6month-tab">
                    <div class="row ">
                        <div class="col-12" style="height: 100px">
                            6month graph
                        </div>
                        <div class="col-12 table">
                            <table class="table table-bordered table-sm tableForeach">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>NAME</th><th>PHONE-NO</th><th>TARGET-VALUE</th><th>ROUTINE-AMOUNT</th><th>STATUS</th><th>TRANSACTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $clientData)
                                        @if($clientData->target_routine=='weekly')
                                            @if($clientData->target_plan=='6-months')
                                                <tr>
                                                    <td>{{ucfirst($clientData->client->last_name)}}{{' '}}
                                                        {{ucfirst($clientData->client->first_name)}}{{' '}}
                                                        {{ucfirst($clientData->client->other_name)}}</td>
                                                    <td>{{$clientData->client->phone}}</td>
                                                    <td>{{$clientData->overall_value}}</td>
                                                    <td>{{$clientData->routine_amount}}</td>
                                                    <td>On-going</td>
                                                    <td data-id="{{$clientData->id}}">
                                                        <?php $id=$clientData->id; $client_id=$clientData->client_id?>
                                                        <a href="{{route('target_owner',['id'=>$id,'client_id'=>$client_id])}}" 
                                                            class="btn btn-sm btn-block btn-primary m-1 p-0 text-white">Transaction Record
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endif
=======
            </div>
            <div class="tab-pane fade col-12" id="nav-w6month" role="tabpanel" aria-labelledby="nav-w6month-tab">
                <div class="row ">
                    <div class="col-12" style="height: 100px">
                        6month graph
                    </div>
                    <div class="col-12 table">
                        <table class="table table-hover table-bordered">
                            <thead class="thead-dark">
                                <tr>
                                    <th>NAME</th><th>PHONE-NO</th><th>TARGET-VALUE</th><th>ROUTINE-AMOUNT</th><th>STATUS</th><th>DETAILS</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $clientData)
                                    @if($clientData->target_routine=='weekly')
                                        @if($clientData->target_plan=='6-months')
                                            <tr>
                                                <td>{{ucfirst($clientData->client->last_name) }}{{' '}}
                                                    {{ucfirst($clientData->client->first_name)}}{{' '}}
                                                    {{ucfirst($clientData->client->other_name)}}</td>
                                                <td>{{$clientData->client->phone}}</td>
                                                <td>{{$clientData->overall_value}}</td>
                                                <td>{{$clientData->routine_amount}}</td>
                                                <td data-id="{{$clientData->id}}">
                                                    <?php $id=$clientData->id; $client_id=$clientData->client_id?>
                                                    <a href="{{route('target_owner',['id'=>$id,'client_id'=>$client_id])}}" 
                                                        class="btn btn-sm btn-block btn-primary m-1 p-0 text-white">Transaction Record
                                                    </a>
                                                </td>
                                            </tr>
>>>>>>> bb1cfd5f5bde8093db318eb89089c0b87920f538
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
<<<<<<< HEAD
                <div class="tab-pane fade col-12" id="nav-wunfixed" role="tabpanel" aria-labelledby="nav-wunfixed-tab">
                    <div class="row ">
                        <div class="col-12" style="height: 100px">
                            unfixed graph
                        </div>
                        <div class="col-12 table">
                            <table class="table table-bordered table-sm tableForeach">
                                <thead class="thead-dark thead">
                                    <tr>
                                        <th>NAME</th><th>PHONE-NO</th><th>TARGET-VALUE</th><th>ROUTINE-AMOUNT</th><th>STATUS</th><th>TRANSACTION</th>
                                    </tr>
                                </thead>
                                <tbody class="tbody">
                                    @foreach ($data as $clientData)
                                        @if($clientData->target_routine=='weekly')
                                            @if($clientData->target_plan=='not-specific')
                                                <tr>
                                                    <td>{{ucfirst($clientData->client->last_name)}}{{' '}}
                                                        {{ucfirst($clientData->client->first_name)}}{{' '}}
                                                        {{ucfirst($clientData->client->other_name)}}</td>
                                                    <td>{{$clientData->client->phone}}</td>
                                                    <td>{{$clientData->overall_value}}</td>
                                                    <td>{{$clientData->routine_amount}}</td>
                                                    <td>On-going</td>
                                                    <td data-id="{{$clientData->id}}">
                                                        <?php $id=$clientData->id; $client_id=$clientData->client_id?>
                                                        <a href="{{route('target_owner',['id'=>$id,'client_id'=>$client_id])}}" 
                                                            class="btn btn-sm btn-block btn-primary m-1 p-0 text-white">Transaction Record
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endif
=======
            </div>
            <div class="tab-pane fade col-12" id="nav-wunfixed" role="tabpanel" aria-labelledby="nav-wunfixed-tab">
                <div class="row ">
                    <div class="col-12" style="height: 100px">
                        unfixed graph
                    </div>
                    <div class="col-12 table">
                        <table class="table table-hover table-bordered">
                            <thead class="thead-dark">
                                <tr>
                                    <th>NAME</th><th>PHONE-NO</th><th>TARGET-VALUE</th><th>ROUTINE-AMOUNT</th><th>STATUS</th><th>DETAILS</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $clientData)
                                    @if($clientData->target_routine=='weekly')
                                        @if($clientData->target_plan=='not-specific')
                                            <tr>
                                                <td>{{ucfirst($clientData->client->last_name) }}{{' '}}
                                                    {{ucfirst($clientData->client->first_name)}}{{' '}}
                                                    {{ucfirst($clientData->client->other_name)}}</td>
                                                <td>{{$clientData->client->phone}}</td>
                                                <td>{{$clientData->overall_value}}</td>
                                                <td>{{$clientData->routine_amount}}</td>
                                                <td data-id="{{$clientData->id}}">
                                                    <?php $id=$clientData->id; $client_id=$clientData->client_id?>
                                                    <a href="{{route('target_owner',['id'=>$id,'client_id'=>$client_id])}}" 
                                                        class="btn btn-sm btn-block btn-primary m-1 p-0 text-white">Transaction Record
                                                    </a>
                                                </td>
                                            </tr>
>>>>>>> bb1cfd5f5bde8093db318eb89089c0b87920f538
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


   


<div class="row">
    <div class="col-12" id="">
        
    </div>
</div>

  

<!-- Modal for selecting the type of client that want to start a target saving -->
<div class="modal fade" id="new-target" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content row">
            <div  class="modal-body">
                <div class="form-check">
                    <input type="radio" name="clientType" id="existingClient" value="existingClient">
                    <label for="existingClient">
                    Existing Client
                    </label>
                </div>
                <div class="form-check">
                    <input type="radio" name="clientType" id="newClient" value="newClient">
                    <label for="newClient">
                    New Client
                    </label>
              </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <!-- button decides whether to show new form for new client or retrieve existing client data depending on what selected-->
                <button type="button" class="btn btn-primary" id="btnCheckClient" data-dismiss="modal" data-toggle="modal" data-target="#retrieveModal">Continue</button> 
            </div>
        </div>
    </div>
</div>


<!-- Modal for retrieving existing client record -->
<div class="modal fade" id="retrieveModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="col-12 mx-md-3">
                    <form method="POST">
                        <div class="row">
                            <label for="branch" class="col-12 mb-1 font-weight-bold">Retrieve Client data with Phone-Number</label>
                            <input type="search" id="phonenumber" placeholder="Client Phone-number to search for his/her record" name="phonenumber" class="mr-5 form-control form-control-sm" required>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button  type="button" class="btn btn-primary searchExistingClient" data-dismiss="modal"  >Search</button>
            </div>
        </div>
    </div>
</div>


<!-- Modal for adding new client -->
<div class="modal fade" id="addNewModal" tabindex="-1" role="dialog" aria-labelledby="addNewModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content card">
            <div class="modal-header">
                <div class="row justify-content-center">
                    <div class="col-12 font-weight-bold">
                       <h5 class="modal-title text-center"> {{ __('Client Registry') }}</h5>
                    </div>
                </div>
            </div>
            <div class="modal-body" id="addNewModalLabel">
                {!! Form::open(['route' => ['target.create_client'], 'method'=>'POST', 'files' => true]) !!}
                <div class="row"> 
                    <div class="col-12 mx-auto">
                     
                       <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="fullname"> {{__('First Name')}} </label>
                                <input required type="text" class="form-control" id="first_name" name="first_name" >
                              </div>
                           </div> 

                           <div class="col-md-6">
                            <div class="form-group">
                                <label for="fullname"> {{__('Last Name')}} </label>
                                <input required type="text" class="form-control" id="last_name" name="last_name">
                              </div>
                           </div>
 
                           <div class="col-md-6">
                            <div class="form-group">
                                <label for="fullname"> {{__('Other Names')}}  <small>(opt)</small>  </label>
                                <input type="text" class="form-control" id="other_name" name="other_name">
                              </div>
                           </div>

                           <div class="col-md-6">
                            <div class="form-group">
                                <label for="phone"> {{__('Telephone')}} </label>
                                <input required type="text" class="form-control" id="phone" name="phone">
                              </div>
                           </div>

                           <div class="col-md-6">
                            <div class="form-group">
                                <label for="email"> {{__('Email Address')}} </label>
                                <input required type="email" class="form-control" id="email" name="email">
                              </div>
                           </div>

                           <div class="col-md-6">
                            <div class="form-group">
                                <label for="str_address"> {{__('Full Address')}} </label>
                                <input required type="text" class="form-control" id="address" name="address">
                              </div>
                           </div>
   

                           <div class="col-md-6">
                            <div class="form-group">
                                <label for="username"> {{__('Username')}} </label>
                                <input required type="text" class="form-control" id="username" name="username">
                            </div>
                           </div>

                           <div class="col-md-6">
                            <div class="form-group">
                                <label for="password"> {{__('Password')}} </label>
                                <input required type="password" class="form-control" id="password" name="password">
                            </div>
                           </div>

                           <div class="col-md-6">
                            <div class="form-group">
                                <label for="password"> {{__('Confirm Password')}} </label>
                                <input required type="password" class="form-control" id="password" name="confirm_password">
                            </div>
                           </div>

                           <div class="col-md-12 pt-3">
                            <div class="form-group "> 
                                <input type="submit" class="btn btn-primary btn-block" id="submit" value="Save client" name="submit">
                            </div>
                           </div>

                       </div>
                        
                    </div> 
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="{{ URL::asset('js/jquery-3.5.1.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/popper.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/bootstrap.min.js') }}"></script>

<script type="text/javascript">
    $(document).ready(function(){
        $('#btnCheckClient').click(function(){
            let clicked=$('input[name=clientType]:checked').val();
            if(clicked!=='existingClient'){
                let namee= $('#btnCheckClient').attr('data-target','#addNewModal');
            }else{
                let namee= $('#btnCheckClient').attr('data-target','#retrieveModal');
            }
        })


        $('.searchExistingClient').click(function(){
            let clientNumber=$(this).parents().find(':input[name=phonenumber]').val();
            $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content')
                        },
                    url:"{{ route('check_existing_client') }}",
                    type:'POST',
                    data:{'phone': clientNumber},
                    dataType:'text',
                    success:function(success){
                        $('#targetform').html(success)
                    },
                    error:function(error){
                        console.log(error);
                    }
            })
        })
        
        $('#newTransaction').click(function(){
            $(window).attr('location',"{{route('target_transaction')}}");
        })
        


        $('#nav-tab1 #nav-daily-tab').on('click', function () {
            $('#nav-tab3').hide();
            $('#nav-tab2').show();
        }) 
        $('#nav-tab1 #nav-weekly-tab').on('click', function () {
            $('#nav-tab2').hide();
            $('#nav-tab3').show();
        })

        //this will check if foreach has loaded any data into the t-body, if empty then this will display message
        $(".tableForeach tbody").each(function(index){
            if($(this).children().length == 0){
                $(this).html('<tr><td class="text-center font-weight-bold py-3"colspan="7"><p class="text-danger">NO TARGET FOR THIS PLAN YET!</p></td></tr>');
            }
        })
    })
</script>
@endsection