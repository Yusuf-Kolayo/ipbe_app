<div class="row">
    <div class="col-12 table-responsive">
        <table class="table table-hover table-bordered table-sm mb-0">
            <thead class="thead-dark">
                <tr class="text-center">
                    <th>REQUEST REPORT</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="pl-1 pr-0"> 
                        @foreach($reqHistory as $reqHistory)
                        <div class="alert alert-pro alert-primary alert-icon px-0 pl-1">
                            <?php 
                                $reqDate = $reqHistory->request_date;
                                $changeReqDate = date("d-m-Y", strtotime($reqDate));
                            ?>
                            <p><i class="icon ni ni-alert-circle mr-2"></i>Target was requested on the <b>{{$changeReqDate}}</b>
                            @if($reqHistory->authorized_request_type=='usr_agent')
                            by an Agent <b>[ {{ ucfirst($reqHistory->agent->agt_last_name)}}{{' '}} {{ucfirst($reqHistory->agent->agt_first_name)}} ]</b>
                            @else
                            by the owner <b>[ {{$reqHistory->client->last_name}} {{$reqHistory->client->first_name}} ]</b>
                            @endif
                            </p>
                            @if($reqHistory->approval_date=='' ||$reqHistory->approval_date=='null')
                            <p><i class="icon ni ni-alert-circle mr-2"></i>Request has not been seen/approved</p>
                            @elseif(($reqHistory->approval_date !=='' && $reqHistory->approval_date !=='null') && ($reqHistory->complete_date=='' ||$reqHistory->complete_date=='null'))
                            <p><i class="icon ni ni-alert-circle mr-2"></i>Request had been seen by Admin <b>{{ucfirst($reqHistory->authorized_approval)}}</b> on the <b>{{$reqHistory->approval_date}}  request is now in-progress</b></p>
                            <p><i class="icon ni ni-alert-circle mr-2"></i>Payback has not been confirmed</p>
                            @else
                            <p><i class="icon ni ni-alert-circle mr-2"></i>Request had been seen by Admin <b>{{ucfirst($reqHistory->authorized_approval)}}</b> on the <b>{{$reqHistory->approval_date}}</b></p>
                            <p><i class="icon ni ni-check-circle mr-2"></i>Request payback has been completed. <b>{{$reqHistory->authorized_completion}}</b> confirmed it on the <b>{{$reqHistory->complete_date}}</b></p>
                            @if(Auth()->User()->usr_type=='usr_agent')<p>Confirm reciept from the customer</p>@endif
                            @endif
                        </div>
                        @endforeach
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="col-12">
        <div class="row">
            <div class="col-8">
                <p class="text-center"><small>COMMENTS <button class="btn btn-sm btn-dark py-0 px-1 ml-1" data-toggle="modal" data-target="#newComment">+</button></small></p>
            </div>
            <div class="col-4">
                <button type="button" class="btn btn-sm btn-outline-dark mt-2" data-dismiss="modal">CLOSE</button>
            </div>
        </div>
    </div>
</div>
