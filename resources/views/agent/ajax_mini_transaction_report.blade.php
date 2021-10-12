@if($clientTarget=='no result')

    <div class="col-md-10 offset-md-1 card my-3 py-2 mr-1 text-center">
        <table>
            <tr>
              <td><h5 class="font-weight-bolder alert alert-danger">Record not found with this Number or Email</h5></td>
            </tr>
        </table>
    </div>
@else
<?php 
     $no=1;   
?>
@foreach($clientTarget as $clientTarget)

    <div class="row ">
        <div class="col-12 table-responsive">
            <table class="my-3 table table-bordered table-sm">
               <div class="row">
                    <div class="col-12 card pb-2 text-center">
                        <p class="font-weight-bold alert alert-primary" >{{strtoupper($clientTarget->client->last_name) }}'S MINI TRANSACTION REPORT {{$no}}</p>
                    </div>
               </div>
                <tr>
                    <th>Name</th>
                    <td>{{ucfirst($clientTarget->client->last_name) }}{{' '}}
                        {{ucfirst($clientTarget->client->first_name) }}{{' '}}
                        {{ucfirst($clientTarget->client->other_name )}}
                    </td>
                </tr>
                <tr>
                    <th>Phone-Number</th>
                    <td>{{$clientTarget->client_no}}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>{{$clientTarget->client_email}}</td>
                </tr>
                <tr>
                    <th>Targeted Reason</th>
                    <td>{{$clientTarget->target_reason}}</td>
                </tr>
                <tr>
                    <th>Targeted Value</th>
                    <td><span class="totalVal">{{$clientTarget->overall_value}}</span></td>
                </tr>
                <tr>
                    <th class="pt-2">Amount Saved</th>
                    <td><button  class="amtSaved btn btn-primary py-0 px-1 my-1 ml-1" data-id="{{$clientTarget->id}}">SHOW <i class="fas fa-eye pl-2"></i></button></td>
                </tr>
                <tr>
                    <?php $id=$clientTarget->id; $client_id=$clientTarget->client_id?>
                    <th> <a href="{{route('target_owner',['id'=>$id,'client_id'=>$client_id])}}" class="btn btn-sm btn-outline-primary mt-1">DETAIL REPORT</a></th>
                    <td>
                        <button type="button" class="btn btn-sm btn-outline-primary reqPay mt-1 ml-1" 
                            data-id="{{$clientTarget->id}}"
                            data-dismiss="modal" data-toggle="modal" data-target="#requestPayback">
                            REQUEST PAYBACK
                        </button>
                    </td>
                </tr>
            </table>
        </div>
    </div>


<?php 
    $no++;   
?>
@endforeach
@endif

<script type="text/javascript">
    $(document).ready(function(){
        $(".amtSaved").click(function(){
                let targetId=$(this).data('id');
                
            if ($(this).html() == 'SHOW <i class="fas fa-eye pl-2"></i>'){
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
                            $this.html(success+'    <i class="fas fa-eye-slash ml-2"></i>');
                            $this.addClass("btn-warning");
                            $this.removeClass("btn-primary");
                        },
                        error:function(error){
                            console.log(error);
                        }
                })
            }else{
                $(this).html('SHOW <i class="fas fa-eye pl-2"></i>');
                $(this).removeClass("btn-warning");
                $(this).addClass("btn-primary");
            }

        })

        $('.reqPay').click(function(){
            let targetId=$(this).data('id');
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content')
                        },
                    url:"{{ route('total_paid') }}",
                    type:'POST',
                    data:{'targetSavingId': targetId},
                    dataType:'text',
                    success:function(success){
                        let amtSaved=success;
                        $('#requestPayback2').on('shown.bs.modal', function () {
                            $(".modal-body #saved").val( amtSaved);
                            $(".modal-body #saved").addClass('font-weight-bold');
                            $(".modal-body #targetId").val( targetId );

                                $.ajax({
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content')
                                        },
                                    url:"{{ route('bank_details') }}",
                                    type:'POST',
                                    data:{'targetIdBank': targetId},
                                    dataType:'text',
                                    success:function(success){
                                        let bankDetails=JSON.parse(success)
                                        $(".modal-body #bankName").val(bankDetails.bank_name);
                                        $(".modal-body #accNo").val(bankDetails.acc_no);
                                        $(".modal-body #accName").val(bankDetails.acc_name);
                                    },
                                    error:function(error){
                                        console.log(error);
                                    }
                                })  
                        });
                    },
                    error:function(error){
                        console.log(error);
                    }
                })       
        
        })

        
    })
</script>
