@extends('layouts.main')

@section('content')

<link rel="stylesheet" href="{{ asset('css/dist/css/reset.css') }}">
<link rel="stylesheet" href="{{ asset('css/dist/css/responsive.css') }}">
<style>
   
</style>
<div class="row card">
    <div class="col-12 card bg-white">
       <h5 class="text-center pt-2">SEARCH FROM EXPENSE RECORD</h5>
    </div>
    <div class="col-12">
        <p class="text-danger pt-1" style="font-size: 0.7rem">You can filter you result with any of the options below</p>
        <div class="row mt-4">
            <div class="col-md-4 px-2 my-2" >
                <div class="row text-center">
                    <div class="col-12">
                        <span>Author</span>
                    </div>
                    <div class="col-12">
                        <input type="text" class="form-control-sm" name="initiator" id="initiator">
                    </div>
                </div>
            </div>
            <div class="col-md-4 px-2 my-2">
                <div class="row text-center">
                    <div class="col-12">
                        <span>Branch</span> 
                    </div>
                    <div class="col-12">
                        <select class="form-control-sm" style="border: 2px solid black;" name="branch" id="branch">
                            <option value="">SELECT</option>
                            <option value="Maryland"> Lagos State-Maryland</option>
                            <option value="Adekoya,Square-Anthony">Adekoya Square, Anthony</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-4 px-2 my-2">
                <div class="row text-center">
                    <div class="col-12">
                        <span>Category</span> 
                    </div>
                    <div class="col-12">
                        <select class="form-control-sm" style="border: 2px solid black;" name="branch" id="category">
                            <option value="">SELECT</option>
                            @foreach($category as $category)
                            <option value="{{$category['expense_catname']}}"> {{$category['expense_catname']}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

        </div>
        <div class="row my-4">
            <div class="col-md-6 px-2 my-2">
                <div class="row text-center text-md-right">
                    <div class="col-12">
                        <span class=" px-5">Start Date </span>  
                    </div>
                    <div class="col-12">
                        <input type="date" class=" form-control-sm" id="fromDate" name="fromDate">
                    </div>
                </div>
            </div>
            <div class="col-md-6 px-2 my-2 " >
                <div class="row text-center text-md-left">
                    <div class="col-12">
                        <span class="px-5">End Date</span>
                    </div>
                    <div class="col-12">
                        <input type="date" class=" form-control-sm "id="toDate" name="toDate">
                    </div>
                </div>
            </div>
            
        </div>
        <div class="row my-2">
            <div class="col-md-4 offset-md-8 px-2">
                <div class="row text-center">
                    <div class="col-12 float-right">
                        <p class="d-inline btn font-weight-bold" id="reset">RESET</p>
                        <button class="btn-primary " id="searchBtn">SEARCH</button>
                    </div>
                </div>
            </div> 
        </div>
    </div>
</div>

<div class="row justify-content-center" id="printitem">
    
</div>

<script type="text/javascript" src="{{ URL::asset('js/jquery-3.5.1.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/popper.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/bootstrap.min.js') }}"></script>

<script type="text/javascript">
    $(document).ready(function(){
        $('.btnprint').on('click',function(){
            alert('here');
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
            let category= $('#category').val();

            let todayDate = new Date().toJSON().slice(0,10);
            
            
            if(fromDate =='' && toDate =='' && initiator == '' && branch =='' && category==''){
                $('#printitem').html("<div class='col-6 text-center'><p class='alert alert-danger'>No selection to search with !!!</p></div>")

            }else if((fromDate =='' && toDate !='')){
                $('#printitem').html("<div class='col-md-5 offset-md-1 text-center'><p class='alert alert-danger'>Start date cannot be empty !</p></div>")
                
            }else if((fromDate !='' && toDate =='')){
                $('#printitem').html("<div class='col-md-5 offset-md-1 text-center'><p class='alert alert-danger'>End date cannot be empty !</p></div>")
                
            }else if((fromDate !='' && fromDate > todayDate)){
                $('#printitem').html("<div class='col-md-5 offset-md-1 text-center'><p class='alert alert-danger'>Start date cannot be greater than today's date !</p></div>")
                
            }else if((toDate !='' && toDate > todayDate)){
                $('#printitem').html("<div class='col-md-5 offset-md-1 text-center'><p class='alert alert-danger'>End date cannot be greater than today's date !</p></div>")
                
            }else if(fromDate > toDate){
                    $('#printitem').html("<div class='col-md-5 offset-md-1 text-center'><p class='alert alert-danger'>From date cannot be greater than End date !</p></div>")
            }else if((toDate > todayDate) && (fromDate > todayDate)){
                    $('#printitem').html("<div class='col-md-5 offset-md-1 text-center'><p class='alert alert-danger'>Dates cannot be greater than today's date !</p></div>")
            }else if((initiator !== '') && (fromDate=='' && toDate=='' && branch=='' && category=='')){
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content')
                        },
                    url:"{{route('name_search')}}",
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

            }else if((branch!=='') && (fromDate=='' && toDate=='' && initiator== '' && category=='')){
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content')
                        },
                    url:"{{route('branch_search')}}",
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

            }else if((category!=='') && (fromDate=='' && toDate=='' && initiator== '' && branch=='')){
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content')
                        },
                    url:"{{route('category_search')}}",
                    type:'GET',
                    data:{'category': category },
                    dataType:'text',
                    success:function(success){
                        $('#printitem').html(success)
                    },
                    error:function(error){
                        console.log(error);
                    }
                })

            }else if((fromDate!=='' && toDate!=='') && (initiator == '' && branch=='' && category=='')){
               $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content')
                        },
                    url:"{{route('date_search')}}",
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
            }else if((fromDate !=='' && toDate !=='' && initiator !== '') && (branch =='' && category=='')){
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content')
                        },
                    url:"{{route('date_name')}}",
                    type:'GET',
                    data:{'fromDate': fromDate,'toDate':toDate, 'initiator':initiator},
                    dataType:'text',
                    success:function(success){
                        $('#printitem').html(success)
                    },
                    error:function(error){
                        console.log(error);                       }
                })
            }else if((fromDate !=='' && toDate !=='' && branch !=='') &&( initiator == '' && category=='')){
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content')
                        },
                    url:"{{route('branch_date')}}",
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
            }else if((fromDate =='' && toDate =='' && category=='') &&( initiator !== '' && branch !=='' )){
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content')
                        },
                    url:"{{route('branch_name')}}",
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

            }else if((initiator !== '' && category!='') &&( fromDate =='' && toDate =='' && branch =='' )){
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content')
                        },
                    url:"{{route('category_name')}}",
                    type:'GET',
                    data:{'category':category,'initiator':initiator},
                    dataType:'text',
                    success:function(success){
                        $('#printitem').html(success)
                    },
                    error:function(error){
                        console.log(error);
                    }
                })

            }else if((fromDate !=='' && toDate !=='' && category!='') &&( initiator == '' && branch =='' )){
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content')
                        },
                    url:"{{route('category_date')}}",
                    type:'GET',
                    data:{'category':category,'fromDate': fromDate,'toDate':toDate,},
                    dataType:'text',
                    success:function(success){
                        $('#printitem').html(success)
                    },
                    error:function(error){
                        console.log(error);
                    }
                })

            }else if((branch !=='' && category!='') &&( initiator == '' && fromDate =='' && toDate ==''  )){
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content')
                        },
                    url:"{{route('category_branch')}}",
                    type:'GET',
                    data:{'category':category,'branch': branch},
                    dataType:'text',
                    success:function(success){
                        $('#printitem').html(success)
                    },
                    error:function(error){
                        console.log(error);
                    }
                })

            }else if((branch !=='' && category!=='' && fromDate !=='' && toDate !=='') &&(initiator =='')){
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content')
                        },
                    url:"{{route('category_branch_date')}}",
                    type:'GET',
                    data:{'category':category,'branch': branch,'fromDate': fromDate,'toDate':toDate},
                    dataType:'text',
                    success:function(success){
                        $('#printitem').html(success)
                    },
                    error:function(error){
                        console.log(error);
                    }
                })

            }else if((branch !=='' && category!=='' && initiator!=='' ) &&(fromDate =='' && toDate =='')){
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content')
                        },
                    url:"{{route('category_branch_name')}}",
                    type:'GET',
                    data:{'category':category,'branch': branch,'initiator': initiator},
                    dataType:'text',
                    success:function(success){
                        $('#printitem').html(success)
                    },
                    error:function(error){
                        console.log(error);
                    }
                })

            }else if((branch !==''&& fromDate !=='' && toDate !==''&& initiator!=='' ) &&(category=='')){
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content')
                        },
                    url:"{{route('date_branch_name')}}",
                    type:'GET',
                    data:{'branch': branch,'initiator': initiator,'fromDate': fromDate,'toDate':toDate},
                    dataType:'text',
                    success:function(success){
                        $('#printitem').html(success)
                    },
                    error:function(error){
                        console.log(error);
                    }
                })

            }else if((category!=='' && fromDate !=='' && toDate !==''&& initiator!=='' ) &&(branch =='')){
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content')
                        },
                    url:"{{route('category_date_name')}}",
                    type:'GET',
                    data:{'category':category,'initiator': initiator,'fromDate': fromDate,'toDate':toDate},
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
                    url:"{{route('search_all')}}",
                    type:'GET',
                    data:{'fromDate': fromDate,'toDate':toDate,'branch':branch,'initiator':initiator,'category':category,},
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
        $('#reset').click(function(){
            $('#fromDate').val('');
            $('#toDate').val('');
            $('#branch').val('');
            $('#initiator').val('');
            $('#category').val('');
        })
    })
</script>

@endsection