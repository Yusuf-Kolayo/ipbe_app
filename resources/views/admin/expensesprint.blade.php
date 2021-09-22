@extends('layouts.main')

@section('content')

<link rel="stylesheet" href="{{ asset('css/dist/css/reset.css') }}">
<link rel="stylesheet" href="{{ asset('css/dist/css/responsive.css') }}">
<style>
   
</style>

<div class="row card">
    <form class="form" action="" method="GET"> 
    <input type="hidden" name="_token" value="{{ csrf_token() }}">  
    <!-- <input type="hidden" name="_method" value="">           -->
        <div class="col-12 form-group mb-0 pt-1">
            <div class="row text-center">
                <div class="col-md-6 text-sm">
                    <div class="row">
                        <div class="col-4 text-center pt-1">
                            <span class="font-weight-bolder">Date Range</span> 
                        </div>
                        <div class="col-8 pt-1">
                            <input type="date" class=" form-control-sm" id="fromDate" name="fromDate">
                        </div>
                    </div>
                </div>    
                
                <div class="col-md-6 text-sm">
                    <div class="row">
                        <div class="col-4 text-center pt-1">
                            <span class="font-weight-bolder">To :</span> 
                        </div>
                        <div class="col-8 pt-1">
                            <input type="date" class=" form-control-sm "id="toDate" name="toDate">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 border-dark form-group my-0">
            <div class="row text-center">
                <div class="col-md-6 text-sm">
                    <div class="row">
                        <div class="col-4 text-center pt-1">
                            <span class="font-weight-bolder">Branch:</span>   
                        </div>
                        <div class="col-8 pt-1">
                            <select class="form-control-sm" style="border: 2px solid black;" name="branch" id="branch">
                            <option value="">SELECT</option>
                                <option value="Maryland"> Lagos State-Maryland</option>
                                <option value="Adekoya,Square-Anthony">Adekoya Square, Anthony</option>
                            </select>
                        </div>
                    </div>
                </div>    
                <div class="col-md-6 text-sm">
                    <div class="row">
                        <div class="col-4 text-center pt-1">
                            <span class="font-weight-bolder">Author:</span>   
                        </div>
                        <div class="col-8 pt-1">
                             <input type="text" class="form-control-sm" name="initiator" id="initiator">
                        </div>
                    </div>
                </div>
            </div>
        </div>    
        <div class="col-12 text-center  my-1">
            <button class="btn-sm btn-primary font-weight-bolder" id="searchBtn">SEARCH</button>
        </div>
    </form>
</div>
<div class="row justify-content-center" id="printitem">
    
</div>

<script type="text/javascript" src="{{ URL::asset('js/jquery-3.5.1.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/popper.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/bootstrap.min.js') }}"></script>

<script type="text/javascript">
    $(document).ready(function(){
        $('.btnprint').on('click',function(){
            let printsection= $("#printitem").html();
            let printpreview=window.open('', 'PRINT', 'height=400,width=800');
           // let printpreview=window.open('', '', 'left=0,top=0,width=1000,height=900,toolbar=0,scrollbars=0,status=0');
            printpreview.document.write('<body >');
            printpreview.document.write('<h1 style="text-align:center">' + document.title  + '</h1>');
            printpreview.document.write(printsection);
            printpreview.document.write('</body></html>');
           
            printpreview.document.close();
            printpreview.focus();
            printpreview.print();
            printpreview.close();

        });

        $('#searchBtn').click(function(){
            event.preventDefault();
            let fromDate = $('#fromDate').val();
            let toDate = $('#toDate').val();
            let branch = $('#branch').val();
            let initiator = $('#initiator').val();

            let todayDate = new Date().toJSON().slice(0,10);
            

            if(fromDate =='' && toDate =='' && initiator == '' && branch ==''){
                $('#printitem').html("<div class='col-6 text-center'><p class='alert alert-danger'>No selection to search with !!!</p></div>")

            }else if((fromDate =='' && toDate !='')){
                $('#printitem').html("<div class='col-6 text-center'><p class='alert alert-danger'>From date cannot be empty !</p></div>")
                
            }else if((fromDate !='' && toDate =='')){
                $('#printitem').html("<div class='col-6 text-center'><p class='alert alert-danger'>To date cannot be empty !</p></div>")
                
            }else if((initiator !== '') && (fromDate=='' && toDate=='' && branch=='')){
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content')
                        },
                    url:"{{url('/company/expenses/search_with_name')}}",
                    type:'GET',
                    data:{'initiator': initiator },
                    dataType:'text',
                    success:function(success){
                         $('#printitem').html(success)
                    },
                    error:function(error){
                        console.log(error);
                    }
                })

            }else if((branch!=='') && (fromDate=='' && toDate=='' && initiator== '')){
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content')
                        },
                    url:"{{url('/company/expenses/search_with_branch')}}",
                    type:'GET',
                    data:{'branch': branch },
                    dataType:'text',
                    success:function(success){
                        $('#printitem').html(success)
                    },
                    error:function(error){
                        console.log(error);
                    }
                })

            }else if((fromDate!=='' && toDate!=='') && (initiator == '' && branch=='')){
                if((fromDate > todayDate) && (toDate <= todayDate) ){
                    $('#printitem').html("<div class='col-6 text-center'><p class='alert alert-danger'>From date cannot be greater than today's date !</p></div>")
                }else if((toDate > todayDate) && (fromDate <= todayDate)){
                    $('#printitem').html("<div class='col-6 text-center'><p class='alert alert-danger'>To date cannot be greater than today's date !</p></div>")
                }else if((toDate > todayDate) && (fromDate > todayDate)){
                    $('#printitem').html("<div class='col-6 text-center'><p class='alert alert-danger'>Dates cannot be greater than today's date !</p></div>")
                }else{
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content')
                            },
                        url:"{{url('/company/expenses/search_with_date')}}",
                        type:'GET',
                        data:{'fromDate': fromDate,'toDate':toDate},
                        dataType:'text',
                        success:function(success){
                            $('#printitem').html(success)
                        },
                        error:function(error){
                            console.log(error);
                        }
                    })
                }

            }else if((fromDate !=='' && toDate !=='' && initiator !== '') && (branch =='')){
                if((fromDate > todayDate) && (toDate <= todayDate)){
                    $('#printitem').html("<div class='col-6 text-center'><p class='alert alert-danger'>From date cannot be greater than today's date !</p></div>")
                }else if((toDate > todayDate) && (fromDate <= todayDate)){
                    $('#printitem').html("<div class='col-6 text-center'><p class='alert alert-danger'>To date cannot be greater than today's date !</p></div>")
                }else if((toDate > todayDate) && (fromDate > todayDate)){
                    $('#printitem').html("<div class='col-6 text-center'><p class='alert alert-danger'>Dates cannot be greater than today's date !</p></div>")
                }else{
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content')
                            },
                        url:"{{url('/company/expenses/search_with_date_and_name')}}",
                        type:'GET',
                        data:{'fromDate': fromDate,'toDate':toDate, 'initiator':initiator},
                        dataType:'text',
                        success:function(success){
                            $('#printitem').html(success)
                        },
                        error:function(error){
                            console.log(error);
                        }
                    })
                }

            }else if((fromDate !=='' && toDate !=='' && branch !=='') &&( initiator == '' )){
                if((fromDate > todayDate) && (toDate <= todayDate)){
                    $('#printitem').html("<div class='col-6 text-center'><p class='alert alert-danger'>From date cannot be empty !</p></div>")
                }else if((toDate > todayDate) && (fromDate <= todayDate)){
                    $('#printitem').html("<div class='col-6 text-center'><p class='alert alert-danger'>To date cannot be empty !</p></div>")
                }else if((toDate > todayDate) && (fromDate > todayDate)){
                    $('#printitem').html("<div class='col-6 text-center'><p class='alert alert-danger'>Dates cannot be greater than today's date !</p></div>")
                }else{$.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content')
                            },
                        url:"{{url('/company/expenses/search_with_date_and_branch')}}",
                        type:'GET',
                        data:{'fromDate': fromDate,'toDate':toDate, 'branch':branch},
                        dataType:'text',
                        success:function(success){
                            $('#printitem').html(success)
                        },
                        error:function(error){
                            console.log(error);
                        }
                    })
                }
            }else if((fromDate =='' && toDate =='') &&( initiator !== '' && branch !=='' )){
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content')
                        },
                    url:"{{url('/company/expenses/search_with_branch_and_name')}}",
                    type:'GET',
                    data:{'branch':branch,'initiator':initiator},
                    dataType:'text',
                    success:function(success){
                        $('#printitem').html(success)
                    },
                    error:function(error){
                        console.log(error);
                    }
                })

            }else{
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content')
                        },
                    url:"{{url('/company/expenses/search_with_all')}}",
                    type:'GET',
                    data:{'fromDate': fromDate,'toDate':toDate,'branch':branch,'initiator':initiator},
                    dataType:'text',
                    success:function(success){
                        $('#printitem').html(success)
                    },
                    error:function(error){
                        console.log(error);
                    }
                })
            }
            
        })
        //the function below will show the tr for total, print and save option depending on if search option is available or not
        if($('#agg').html() == ''){
            $('.totsavprin').hide();

        }else{
            $('.totsavprin').show(); 
        }
    })
</script>

@endsection