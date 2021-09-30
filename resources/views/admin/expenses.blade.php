@extends('layouts.main')

@section('content')

<link rel="stylesheet" href="{{ asset('css/dist/css/reset.css') }}">
<link rel="stylesheet" href="{{ asset('css/dist/css/responsive.css') }}">
<style>
   
</style>



<div class="row">
    <div class="col-12">
        <h5 class="mb-0 text-right btn btn-sm btn-primary px-5 mb-2" id="listExpenes" >ALL RECORDED EXPENSES</h5>
        <button class="btn btn-lg btn-primary py-0 float-right" id="showsearch"><i class="fas fa-search"></i></button>
        <h5 class="mb-0 text-right btn btn-sm btn-danger float-right mx-3" id="addExpenseBtn">ADD NEW EXPENSE</h5>
    </div>
</div>

<div class="row card bg-black"id="searchdiv" style="display: none;">
    <div class="col-12 bg-white">
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
                <div class="row text-center text-md-right ">
                    <div class="col-12">
                        <span class=" px-5">Start Date </span>  
                    </div>
                    <div class="col-12">
                        <input type="date" class=" form-control-sm" id="fromDate" name="fromDate">
                    </div>
                </div>
            </div>
            <div class="col-md-6 px-2 my-2" >
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
                        <p class="d-inline btn text-white"id="reset">RESET</p>
                        <button class="btn-primary " id="searchBtn">SEARCH</button>
                    </div>
                </div>
            </div> 
        </div>
    </div>
</div>

<div class="row card table-responsive text-wrap">
    <div col="12" id="printitem">
        <table id="table" class="table-bordered table-hover table">
            <thead>
                <tr>
                    <th><input type="checkbox" id="selectBox"/></th>
                    <th>ExpID</th>
                    <th>DATE</th>
                    <th>AUTHOR</th>
                    <th>CATEGORY</th>
				    <th>AMOUNT</th>
                    <th>BRANCH</th>
                    <th>DESCRIPTION</th>
                    <th>FILE</th>
                    <th colspan="2" class="text-center">ACTION</th>
                 </tr>
            </thead>
            <tbody>
                @foreach($Expense as $allExpense) 
                
                <tr class="rowprint">
                    <td><input id="optionsCheckbox" class="checkBox" name="selector[]" type="checkbox" value=""></td>
                    <td class="d-none">{{$allExpense['id']}}</td>
                    <td>{{$no}}</td>
                	<td>{{ \Carbon\Carbon::parse($allExpense['date'])->format('d/m/Y')}}
                        </td>
                    <td>{{$allExpense['initiator']}}</td>
                	<td>{{$allExpense['expense_catname']}}</td>
                	<td><b>N</b>{{$allExpense['amount']}}</td>
                    <td>{{$allExpense['branch']}}</td>
                	<td>{{$allExpense['description']}}</td>
                	<td><p id="#holdProof"><a href="{{ asset("expenseproof/{$allExpense['evidence']}") }}" target="blank" id="reciept">
                    view   
                    </a></p></td>
                	<td><button type="button" class="btn btn-primary btn-sm btnprint"> <i class="far fa-file-powerpoint pr-1"></i> Print</button></td>
                    <td>
                            <button type="button" class="btn btn-danger btn-sm deleteExpense" data-id="{{$allExpense['expense_id']}}"> 
                                <i class="fas fa-trash-alt pr-1"></i>  Delete
                            </button>
                        
                    </td>
                </tr> 
                <p class="d-none">{{$no++}}</p>
                @endforeach
                     
            </tbody>
        </table>  
    </div>
</div>

<script type="text/javascript" src="{{ URL::asset('js/jquery-3.5.1.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/popper.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/bootstrap.min.js') }}"></script>

<script type="text/javascript">
    $(document).ready(function(){
        $('.btnprint').on('click',function(){
            let printsection = $(this).closest('tr').html();
            let picture=$('#holdProof #reciept').attr('href'); 
            let printpreview=window.open('', 'PRINT', 'height=600,width=1000');
           // let printpreview=window.open('', '', 'left=0,top=0,width=1000,height=900,toolbar=0,scrollbars=0,status=0');
            printpreview.document.write('<body >');
            printpreview.document.write('<h1 style="text-align:center"> EXPENSES INVENTORY </h1>');
            printpreview.document.write(printsection);
            printpreview.document.write(' <img src='+picture+' width="40%" height="30%" alt="proof">');
            printpreview.document.write('</body></html>');
           
            printpreview.document.close();
            printpreview.focus();
            printpreview.print();
            printpreview.close();

        });

        $('#showsearch').click(function(){
            if($('#searchdiv').is(":hidden")){
                $('#searchdiv').show();
            }else{
                $('#searchdiv').hide();
            }
        })

        $('.deleteExpense').click(function(e){
            let id = $(this).data('id');
            $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content')
                        },
                    url:"{{url('/company/expenses/delete_expense')}}"+id,
                    type:'post',
                    data:{'expense_id': id },
                    dataType:'text',
                    success:function(come){
                        document.write('success I brought'+ come +'back')
                        //$(window).attr('location','/company/expenses/all')
                    },
                    error:function(error){
                        console.log(error);
                    }
                })
        })

        $('#addExpenseBtn').click(function (){
            $(window).attr('location','/company/expenses/add_newexpenses');
        })
        $('#listExpenes').click(function(){
            location.reload();
        })
        
        
        $('#selectBox').click(function(){
            
            if ($(this).is(':checked')) {
                $('.checkBox').attr('checked', true);
            } else {
                $('.checkBox').attr('checked', false);
            }
               
        })

        $('#searchBtn').click(function(){
            event.preventDefault();
            let fromDate = $('#fromDate').val();
            let toDate = $('#toDate').val();
            let branch = $('#branch').val();
            let initiator = $('#initiator').val();
            let category= $('#category').val();

            let todayDate = new Date().toJSON().slice(0,10);
            
            
            if(fromDate =='' && toDate =='' && initiator == '' && branch =='' && category==''){
                $('#printitem').html("<div class='col-md-6 offset-md-3 text-center'><p class='alert alert-danger'>No selection to search with !!!</p></div>")

            }else if((fromDate =='' && toDate !='')){
                $('#printitem').html("<div class='col-md-6 offset-md-3 text-center'><p class='alert alert-danger'>Start date cannot be empty !</p></div>")
                
            }else if((fromDate !='' && toDate =='')){
                $('#printitem').html("<div class='col-md-6 offset-md-3 text-center'><p class='alert alert-danger'>End date cannot be empty !</p></div>")
                
            }else if((fromDate !='' && fromDate > todayDate)){
                $('#printitem').html("<div class='col-md-6 offset-md-3 text-center'><p class='alert alert-danger'>Start date cannot be greater than today's date !</p></div>")
                
            }else if((toDate !='' && toDate > todayDate)){
                $('#printitem').html("<div class='col-md-6 offset-md-3 text-center'><p class='alert alert-danger'>End date cannot be greater than today's date !</p></div>")
                
            }else if((toDate > todayDate) && (fromDate > todayDate)){
                    $('#printitem').html("<div class='col-md-6 offset-md-3 text-center'><p class='alert alert-danger'>Dates cannot be greater than today's date !</p></div>")
            }else if((initiator !== '') && (fromDate=='' && toDate=='' && branch=='' && category=='')){
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

            }else if((branch!=='') && (fromDate=='' && toDate=='' && initiator== '' && category=='')){
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

            }else if((category!=='') && (fromDate=='' && toDate=='' && initiator== '' && branch=='')){
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content')
                        },
                    url:"{{url('/company/expenses/search_with_category')}}",
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

            }else if((fromDate !=='' && toDate !=='' && initiator !== '') && (branch =='' && category=='')){
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
            }else if((fromDate !=='' && toDate !=='' && branch !=='') &&( initiator == '' && category=='')){
                $.ajax({
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
            }else if((fromDate =='' && toDate =='' && category=='') &&( initiator !== '' && branch !=='' )){
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

            }else if((initiator !== '' && category!='') &&( fromDate =='' && toDate =='' && branch =='' )){
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content')
                        },
                    url:"{{url('/company/expenses/search_with_category_and_name')}}",
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
                    url:"{{url('/company/expenses/search_with_category_and_date')}}",
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
                    url:"{{url('/company/expenses/search_with_category_and_branch')}}",
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
                    url:"{{url('/company/expenses/search_with_category_and_branch_and_date')}}",
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
                    url:"{{url('/company/expenses/search_with_category_and_branch_and_name')}}",
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
                    url:"{{url('/company/expenses/search_with_date_and_branch_and_name')}}",
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
                    url:"{{url('/company/expenses/search_with_date_and_category_and_name')}}",
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
                    url:"{{url('/company/expenses/search_with_all')}}",
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
