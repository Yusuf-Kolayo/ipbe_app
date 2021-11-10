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
    <div class="row card pt-4">
        <div class="col-md-6 offset-md-3">

            <div class="row">
                <div class="col-12 my-2">
                    <p class="font-weight-bold">Provide the target owner's Phone-number or Email</p>
                </div>
                <div class="col-12 mb-1">
                    <input type="text" name="numOrEmail" class="form-control form-control-sm">
                </div>
            </div>
           
            <div class="row  mb-2">
                <div class="col-12 text-right ">
                    <button class="chkData btn btn-sm btn-primary py-0 font-weight-bold">CHECK</button>
                </div> 
            </div>
        </div>
    </div>
    <div class="row mt-2" id="recordTrans">

    </div>

<script type="text/javascript" src="{{ URL::asset('js/jquery-3.5.1.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/popper.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/bootstrap.min.js') }}"></script>

<script type="text/javascript">
    $(document).ready(function(){
        $('.chkData').click(function(){
            let clientInfo=$(this).parents().find(':input[name=numOrEmail]').val();
            if(clientInfo==''){
                $('#recordTrans').html('<div class="col-md-6 offset-md-3 card my-3 py-2 mr-1 text-center"><h5 class="alert alert-danger">Provide the client\'s number or email you want to record new transaction for her target</h5></div>')
            }else{
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content')
                        },
                    url:"{{ route('target_existence') }}",
                    type:'POST',
                    data:{'clientInfo': clientInfo},
                    dataType:'text',
                    success:function(success){
                        $('#recordTrans').html(success)
                    },
                    error:function(error){
                        console.log(error);
                    }
                })
            }
        })
    })
</script>

@endsection