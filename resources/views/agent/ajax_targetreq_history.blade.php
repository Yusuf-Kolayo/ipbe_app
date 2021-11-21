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
                    <td> 
                        @foreach($reqHistory as $reqHistory)
                        <div class="alert alert-pro alert-primary alert-icon">
                            <?php 
                                $reqDate = $reqHistory->request_date;
                                $changeReqDate = date("d-m-Y", strtotime($reqDate));

                                $appDate = $reqHistory->approval_date;
                                $changeAppDate = date("d-m-Y", strtotime($appDate));

                                $comDate = $reqHistory->complete_date;
                                $changeComDate = date("d-m-Y", strtotime($comDate));
                            ?>
                            <p><i class="icon ni ni-alert-circle mr-2"></i>Target was requested for on the <b>{{$changeReqDate}}</b></p>
                            @if($reqHistory->approval_date=='' ||$reqHistory->approval_date=='null')
                            <p><i class="icon ni ni-alert-circle mr-2"></i>Request has not been approved</p>
                            @elseif($reqHistory->approval_date !=='' && $reqHistory->approval_date !=='null')
                            <p><i class="icon ni ni-alert-circle mr-2"></i>Request has been approved by <b>{{$reqHistory->authorized_approval}}</b> on the <b>{{$changeAppDate }}</b></p>
                                @if($reqHistory->complete_date=='' ||$reqHistory->complete_date=='null')
                                <p><i class="icon ni ni-alert-circle mr-2"></i>Payback has not been confirmed</p>
                                @else
                                <p><i class="icon ni ni-check-circle mr-2"></i>Request payback has been completed. <b>{{$reqHistory->authorized_complete}}</b> ... <b>{{$changeComDate }}</b></p>
                                <p>Confirm reciept from your customer</p>
                                @endif
                            @endif
                        </div>
                        @endforeach
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="col-12 text-right">
        <button type="button" class="btn btn-outline-dark mt-2" data-dismiss="modal">CLOSE</button>
    </div>
</div>