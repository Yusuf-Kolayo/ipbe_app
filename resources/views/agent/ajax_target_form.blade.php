@isset($existingClient)
    @if($existingClient=='no record')
        <div class="col-md-8 offset-md-2 card my-3 py-2 mr-1 text-center">
            <h5 class="font-weight-bolder alert alert-danger">No client number match the provided number !<br> Update your client profile and Try again or Register your client as a New customer</h5>
        </div>
    @else
    <div class="col-md-10 offset-md-1 card px-5 rounded" id="targetForm">
        <div class="row my-2 text-center">
            <div class="col-12" >
                <h4>Target Saving Registration</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <form action="" method="POST">
                    <div class="row form-group">
                        <input type="text" class="form-control form-control-sm" name="clientId" hidden value="{{$existingClient->client_id}}">
                        <div class="col-md-6 pr-md-3">
                            <label for="name"><b>Name</b></label>
                            <input type="text" class="form-control form-control-sm" id="name" disabled
                            value="{{ucfirst($existingClient->last_name)}} {{' '}} {{ucfirst($existingClient->first_name)}} {{' '}} {{ucfirst($existingClient->other_name)}}">
                        </div>
                        <div class="col-md-6 pl-md-3">
                            <label for="email"><b>Email address</b></label>
                            <input type="email" class="form-control form-control-sm" id="email" name="clientEmail" disabled
                            value="{{$existingClient->user->email}}">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-6 pr-md-3">
                            <label for="number"><b>Phone-Number</b></label>
                            <input type="text" class="form-control form-control-sm" id="number" name="clientNo"disabled
                            value="{{$existingClient->phone}}">
                        </div>
                        <div class="col-md-6 pl-md-3">
                            <label for="homeadd"><b>Home/Office address</b></label>
                            <input type="text" class="form-control form-control-sm" id="homeadd" disabled
                            value="{{$existingClient->address}}">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-6 pr-md-3">
                            <label for="targetvalue"><b>Target Overall Value</b></label>
                            <input type="text" class="form-control form-control-sm" id="targetvalue" name="targetvalue">
                        </div>
                        <div class="col-md-6 pl-md-3"> 
                            <label for="targetplan"><b>Target Plan</b></label>
                            <select class="custom-select custom-select-sm" id="targetplan" name="targetplan">
                                <option value="">Select target-saving type</option>
                                <option value="Monthly">Monthly</option>
                                <option value="3-months">Quarterly (3-months)</option>
                                <option value="6-months">Half-yearly (6-months)</option>
                                <option value="not-specific">No specific duration (<b> A week notice must be given for this plan</b>)</option>
                            </select>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-6 pr-md-3">
                            <label for="targetreason"><b>Target Reason</b></label>
                            <textarea class="form-control" id="targetreason" rows="2" name="targetreason"></textarea>
                        </div>
                        <div class="col-md-6 pl-md-3">
                            <label for="targetroutine"><b>Target Routine</b></label>
                            <select class="custom-select custom-select-sm" id="targetroutine" name="targetroutine">
                                <option value="">Select target-saving routine</option>
                                <option value="daily">Daily</option>
                                <option value="weekly">Weekly</option>
                            </select>
                        </div>    
                    </div>
                    <div class="row form-group">
                        <div class="col-md-6 pr-md-3">
                            <label for="routineamt"><b>Target Routine-Amount</b></label>
                            <input type="text" class="form-control form-control-sm" id="routineamt" name="routineamt">
                            <small class="form-text text-muted">How much will you be saving daily/weekly?</small>
                        </div>
                        <div class="col-md-6 pl-md-3">
                            <label for="bankname"><b>Bank Name</b></label>
                            <input type="text" class="form-control form-control-sm" id="bankname" name="bankname">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-6 pr-md-3">
                            <label for="accno"><b>Account Number</b></label>
                            <input type="text" class="form-control form-control-sm" id="accno" name="accno">
                        </div>
                        <div class="col-md-6 pl-md-3">
                            <label for="accname"><b>Account Name</b></label>
                            <input type="text" class="form-control form-control-sm" id="accname" name="accname">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 card text-center alert alert-danger d-none" id="statusError">

                        </div>
                        <div class="col-12 card text-center alert alert-success d-none" id="statusSuccess">

                        </div>
                    </div>
                    <div class="row text-right">
                        <div class="col-12 mb-2">
                            <button type="submit" class="btn btn-sm btn-primary font-weight-bold px-4"  id="createAcc">CREATE</button>
                            <button type="button" data-dismiss="modal" class="btn btn-sm btn-danger font-weight-bold px-4"  id="closeModal">CLOSE</button>
                        </div>
                    </div>
                  </form>
            </div>
        </div>
    </div>
    
<script type="text/javascript" src="{{ URL::asset('js/jquery-3.5.1.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/popper.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/bootstrap.min.js') }}"></script>

<script type="text/javascript">
    $(document).ready(function(){
        $('#createAcc').click(function(){
            event.preventDefault();
            let clientId=$('input[name=clientId]').val();
            let accno=$('input[name=accno]').val();
            let accname=$('input[name=accname]').val();
            let bankname=$('input[name=bankname]').val();
            let routineamt=$('input[name=routineamt]').val();
            let clientNo=$('input[name=clientNo]').val();
            let clientEmail=$('input[name=clientEmail]').val();
            let targetroutine=$('#targetroutine').val();
            let targetreason=$('#targetreason').val();
            let targetplan=$('#targetplan').val();
            let targetvalue=$('input[name=targetvalue]').val();

            $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content')
                        },
                    url:"{{ route('create_target_account') }}",
                    type:'POST',
                    data:{'clientId': clientId, 'accno': accno, 'accname': accname, 'bankname': bankname, 'routineamt': routineamt,
                            'targetroutine': targetroutine, 'targetreason': targetreason,'targetplan': targetplan, 'targetvalue': targetvalue,
                            'clientNo':clientNo,'clientEmail':clientEmail,
                        },
                    dataType:'text',
                    success:function(success){
                        if(success=='success'){
                            let successStatus='Target created successfully, Remember to always save !'
                            $('#createAcc').attr("disabled","disabled");
                            if($('#statusError').is(':visible')){
                               $('#statusError').toggleClass("d-none");
                               $('#statusSuccess').toggleClass("d-none");
                               $('#statusSuccess').html(successStatus);
                               
                            }else{
                                $('#statusSuccess').toggleClass("d-none");
                                $('#statusSuccess').html(successStatus);
                            }
                            
                        }else{
                            const validatError= success;
                            const accessError= JSON.parse(validatError);
                            let text = "";
                            for (let i = 0; i < accessError.error.length; i++) {
                                text +=accessError.error[i] + "<br>";
                            }
                            if($('#statusSuccess').is(':visible')){
                               $('#statusSuccess').toggleClass("d-none");
                               $('#statusError').toggleClass("d-none");
                                $('#statusError').html(text);
                            }else{
                                $('#statusError').toggleClass("d-none");
                                $('#statusError').html(text);
                            } 
                            
                        }
                    },
                    error:function(error){
                        console.log(error);
                    }
            })
        })
        $("#closeModal").click(function(){
            $('#targetForm').hide()
        })

    })
</script>
@endif
@endisset