<div class="tab-content row" id="nav-tabContent">
    <div class="tab-pane fade show active col-12" id="nav-daily" role="tabpanel" aria-labelledby="nav-daily-tab">
        <div class="tab-content row" id="nav-tabContent">
            <div class="tab-pane fade show active col-12" id="nav-monthly" role="tabpanel" aria-labelledby="nav-monthly-tab">
                <div class="row ">
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
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
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
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
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
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
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
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="tab-pane fade show col-12" id="nav-weekly" role="tabpanel" aria-labelledby="nav-weekly-tab">
        <div class="tab-content row" id="nav-tabContent">
            <div class="tab-pane fade show active col-12" id="nav-wmonthly" role="tabpanel" aria-labelledby="nav-wmonthly-tab">
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
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
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
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
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
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
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