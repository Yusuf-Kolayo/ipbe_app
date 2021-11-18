<?php $no=1;?>                
@foreach($requests as $request)
<tr>
    <td>{{$no}}</td>
    <td>{{ucfirst($request->target_saving->client->last_name) }}{{' '}}
        {{ucfirst($request->target_saving->client->first_name) }}{{' '}}
        {{ucfirst($request->target_saving->client->other_name )}}</td>
        <td>{{$request->target_saving->client_no}}</td>
        <td>{{$request->amount_saved}}</td>
        <td>{{$request->payment_method}}</td>
        @if($request->payment_method !=='Cash')
        <td>{{$request->bank_name}}</td>
        <td>{{$request->acc_no}}</td>
        <td>{{$request->acc_name}}</td>
        @else
        <td>NULL</td>
        <td>NULL</td>
        <td>NULL</td>
        @endif
        <td>
            @if($request->request_status=='Completed')
                <button class="btn btn-sm btn-outline-success px-1 changeStatus" data-reqtarid="{{$request->target_saving_id}}">Completed</button>
            @elseif($request->request_status=='In-progress')
                <button class="btn btn-sm btn-outline-primary px-1 changeStatus" data-reqtarid="{{$request->target_saving_id}}">In-progress</button>
            @else
                <button class="btn btn-sm btn-outline-danger px-1 changeStatus" data-reqtarid="{{$request->target_saving_id}}">Pending</button>
            @endif
        </td>
        <td class="px-1">
            <button class="btn-sm btn btn-outline-warning reqHistory text-black ml-1"
            type="button" data-reqId="{{$request->request_id}}" data-toggle="modal" data-target="#statusRequest" >Record</button>  
        </td>
        <td class="text-center">
            <?php 
                $id=$request->target_saving_id; 
                $client_id=$request->target_saving->client_id;
            ?>
            <a href="{{route('target_owner',['id'=>$id,'client_id'=>$client_id])}}" target="_blank"
                class="btn btn-sm btn-block btn-dark">i
            </a>
        </td>
        <td class="text-center px-1 pt-1">
            <button class="btn btn-sm btn-outline-danger btn-round py-1 deletTarget btn-block " data-reqid="{{$request->request_id}}"><i class="fas fa-trash-alt text-danger"></i></button>
        </td>
    </tr>
    <?php $no++?>
    @endforeach

<script type="text/javascript" src="{{ URL::asset('js/jquery-3.5.1.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/popper.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/bootstrap.min.js') }}"></script>


<script type="text/javascript">
    $(document).ready(function(){
        let comment=$('input[name=comment').val();
        if(comment !=='' && comment !=='undefined'){
            $('#saveComment').removeAttr('disabled');
        }else{
            $('#saveComment').attr('disabled','disabled');
        }

        $('.reqHistory').click(function(){
            
            let reqId=$(this).data('reqid');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content')
                    },
                url:"{{ route('request_history') }}",
                type:'POST',
                data:{'reqId': reqId},
                dataType:'text',
                success:function(success){
                    $("#statusRequest .modal-body").html(success);
                },
                error:function(error){
                    console.log(error);
                }
            })
        })

        //function to show modal to change status for Admin
        $('.changeStatus').click(function(){
            let progress=$(this).html();
            let targetId=$(this).data('reqtarid');
           
            $("#miniReport").modal("show");
            $("#miniReport").on('shown.bs.modal', function () {
                let foot=$("#miniReport .modal-footer").button();
                if($('#miniReport .modal-footer .btn-outline-danger').length == 0) {
                    if(progress=='In-progress'||progress=='Completed'){
                        let okay="<button class='btn btn-sm btn-outline-danger' id='continue' data-dismiss='modal'>CONTINUE</button>";
                        $(foot).prepend(okay);
                    }
                }
                
                if(progress=='In-progress'){
                    $("#miniReport .modal-title").html("REQUEST PROGRESS : "+ progress);
                    $("#miniReport .modal-body").html('You are about to change the progress status to completed<br>Are you sure pay-back has been completed?');
                }else if(progress=='Completed'){
                        $("#miniReport .modal-title").html("REQUEST PROGRESS : "+ progress);
                        $("#miniReport .modal-body").html('This Request has been completed<br>Are you sure you want to change status back to In-progess?');
                }else{
                        $("#miniReport .modal-title").html("REQUEST PROGRESS : "+ progress);
                        $("#miniReport .modal-body").html('You just acknowledge this request, Request is now in-progress<br>Make sure to follow up !');
                        $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content')
                            },
                        url:"{{ route('change_status') }}",
                        type:'POST',
                        data:{'targetId': targetId,'progress': progress},
                        dataType:'text',
                        success:function(success){

                        },
                        error:function(error){
                            console.log(error);
                        }
                    })
                }
                
                $('#continue').click(function(){
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content')
                            },
                        url:"{{ route('change_status') }}",
                        type:'POST',
                        data:{'targetId': targetId,'progress': progress},
                        dataType:'text',
                        error:function(error){
                            console.log(error);
                        }
                    })
                })
            })
        })

        $('.deletTarget').click(function(){
            let origin   = window.location.origin;
            let reqId= $(this).data('reqid');

            Swal.fire({
                    icon: 'question',
                    title: 'Are you sure you want to delete this request?',
                    showDenyButton: true,
                    showCancelButton: true,
                    confirmButtonText: 'Delete',
                    showLoaderOnConfirm: true,
                    cancelButtonText: `Don't delete`,
                    }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                         $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content')
                            },
                            url:"{{route('delete_request') }}",
                            data:{'reqId':reqId},
                            dataType:'json',
                            type:'POST',
                            success:function(response){
                                $.ajax({
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content')
                                    },
                                    type:'POST',
                                    url:"{{route('refresh_request_div') }}",
                                    success:function(success){
                                        $('#tbody').html(success);
                                    },
                                });
                                $("#showMsg").addClass('d-none');
                                $("#showMsg3").addClass('d-none');
                                Swal.fire('Target request deleted successfully!', '', 'success')
                            },
                            error:function(error){
                                $("#showMsg").removeClass('d-none');
                                $("#showMsg3").removeClass('d-none');
                                if(error.errorMsg){
                                    $("#showMsg4").html(error.errorMsg);
                                }else{
                                    $("#showMsg4").html('Could not delete target request, if problem pesist contact your web assistance');
                                }
                            }
                        })
                    }else if (result.isCancel) {
                        Swal.fire('Target request is not deleted', '', 'error')
                    }
                })
           
        })
    })
</script>