<div class="col-md-10 card offset-md-1">
    <div class="row">
        <div class="col-12 text-center py-2 card-header">
            <h5>EXPENSES INVENTORY</h5>
        </div>
    </div>
    <div class="row table table-bordered table-responsive card-body">
        <div class="col-12 text-center ">
            <table class="table">
                @if($sum!==0)
                <thead class="thead-dark">
                    <tr>
                        <th>S/N</th><th>DATE</th><th>NAME</th><th>BRANCH</th><th>CATEGORY</th><th>DESCRIPTION</th><th>PROOF</th><th>AMOUNT</th>
                    </tr>
                </thead>
                <tbody>
                @endif
                    @if($sum==0)
                        <tr>
                            <div class="col-md-6 card pt-3 offset-md-3">
                                <p class="alert alert-danger">No record found</p>
                            </div>
                        </tr>
                    @endif
            @isset($searchName)
                @if(!empty($searchName))
                    @foreach($searchName as $searchName)
                    <tr>
                        <td>{{$no}}</td>
                        <td>{{\Carbon\Carbon::parse($searchName->date)->format('d/m/Y')}}</td>
                        <td>{{$searchName->initiator}}</td>
                        <td>{{$searchName->branch}}</td>
                        <td>{{$searchName->expense_catname}}</td>
                        <td>{{$searchName->description}}</td>
                        <td>
                            <a href="{{ asset("expenseproof/{$searchName->evidence}") }}"" target="blank" id="receipt">View</a>
                        </td>
                        <td id="total"><b>N</b>{{$searchName->amount}}</td>
                        <p class="d-none">{{$no++}}</p>
                    </tr>
                    @endforeach
                    @if($sum !==0)
                        <tr class="totsavprin">
                        <th colspan="2">TOTAL</th><th colspan="6" class="text-right "><span class="font-weight-bold">NGN</span>{{' '}}{{$sum}}</th>
                    </tr>

                    <tr class="totsavprin">
                        <th colspan="8">
                            <button class="btn btn-sm btn-outline-warning font-weight-bolder my-3 ">SAVE</button>
                            <button class="btn btn-sm btn-outline-primary btnprint my-3 font-weight-bolder ">PRINT</button> 
                        </th>
                    </tr>
                    @endif
                @endif
            @endisset

            @isset($searchBranch)
                @if(!empty($searchBranch))
                    @foreach($searchBranch as $searchName)
                    <tr>
                        <td>{{$no}}</td>
                        <td>{{\Carbon\Carbon::parse($searchName->date)->format('d/m/Y')}}</td>
                        <td>{{$searchName->initiator}}</td>
                        <td>{{$searchName->branch}}</td>
                        <td>{{$searchName->expense_catname}}</td>
                        <td>{{$searchName->description}}</td>
                        <td>
                            <a href="{{ asset("expenseproof/{$searchName->evidence}") }}"" target="blank" id="receipt">View</a>
                        </td>
                        <td id="total"><b>N</b>{{$searchName->amount}}</td>
                        <p class="d-none">{{$no++}}</p>
                    </tr>
                    @endforeach
                    @if($sum !==0)
                        <tr class="totsavprin">
                        <th colspan="2">TOTAL (N)</th><th colspan="6" class="text-right ">{{$sum}}</th>
                    </tr>

                    <tr class="totsavprin">
                        <th colspan="8">
                            <button class="btn-sm btn-warning font-weight-bolder my-3 ">SAVE</button>
                            <button class="btn-sm btn-primary btnprint my-3 font-weight-bolder ">PRINT</button> </th>
                    </tr>
                    @endif
                @endif
            @endisset

            @isset($searchDate)    
                @if(!empty($searchDate))
                    @foreach($searchDate as $searchName)
                    <tr>
                        <td>{{$no}}</td>
                        <td>{{\Carbon\Carbon::parse($searchName->date)->format('d/m/Y')}}</td>
                        <td>{{$searchName->initiator}}</td>
                        <td>{{$searchName->branch}}</td>
                        <td>{{$searchName->expense_catname}}</td>
                        <td>{{$searchName->description}}</td>
                        <td>
                            <a href="{{ asset("expenseproof/{$searchName->evidence}") }}"" target="blank" id="receipt">View</a>
                        </td>
                        <td id="total"><b>N</b>{{$searchName->amount}}</td>
                        <p class="d-none">{{$no++}}</p>
                    </tr>
                    @endforeach
                    @if($sum !==0)
                        <tr class="totsavprin">
                        <th colspan="2">TOTAL (N)</th><th colspan="6" class="text-right ">{{$sum}}</th>
                    </tr>

                    <tr class="totsavprin">
                        <th colspan="8">
                            <button class="btn-sm btn-warning font-weight-bolder my-3 ">SAVE</button>
                            <button class="btn-sm btn-primary btnprint my-3 font-weight-bolder ">PRINT</button> </th>
                    </tr>
                    @endif
                @endif
            @endisset

            @isset($searchDateBranch)    
                @if(!empty($searchDateBranch))
                    @foreach($searchDateBranch as $searchName)
                    <tr>
                        <td>{{$no}}</td>
                        <td>{{\Carbon\Carbon::parse($searchName->date)->format('d/m/Y')}}</td>
                        <td>{{$searchName->initiator}}</td>
                        <td>{{$searchName->branch}}</td>
                        <td>{{$searchName->expense_catname}}</td>
                        <td>{{$searchName->description}}</td>
                        <td>
                            <a href="{{ asset("expenseproof/{$searchName->evidence}") }}"" target="blank" id="receipt">View</a>
                        </td>
                        <td id="total"><b>N</b>{{$searchName->amount}}</td>
                    </tr>
                    <p class="d-none">{{$no++}}</p>
                    @endforeach
                    @if($sum !==0)
                        <tr class="totsavprin">
                        <th colspan="2">TOTAL (N)</th><th colspan="6" class="text-right ">{{$sum}}</th>
                    </tr>

                    <tr class="totsavprin">
                        <th colspan="8">
                            <button class="btn-sm btn-warning font-weight-bolder my-3 ">SAVE</button>
                            <button class="btn-sm btn-primary btnprint my-3 font-weight-bolder ">PRINT</button> </th>
                    </tr>
                    @endif
                @endif
            @endisset
            
            @isset($searchDateName)    
                @if(!empty($searchDateName))
                    @foreach($searchDateName as $searchName)
                    <tr>
                        <td>{{$no}}</td>
                        <td>{{\Carbon\Carbon::parse($searchName->date)->format('d/m/Y')}}</td>
                        <td>{{$searchName->initiator}}</td>
                        <td>{{$searchName->branch}}</td>
                        <td>{{$searchName->expense_catname}}</td>
                        <td>{{$searchName->description}}</td>
                        <td>
                            <a href="{{ asset("expenseproof/{$searchName->evidence}") }}"" target="blank" id="receipt">View</a>
                        </td>
                        <td id="total"><b>N</b>{{$searchName->amount}}</td>
                        <p class="d-none">{{$no++}}</p>
                    </tr>
                    @endforeach
                    @if($sum !==0)
                        <tr class="totsavprin">
                        <th colspan="2">TOTAL (N)</th><th colspan="6" class="text-right ">{{$sum}}</th>
                    </tr>

                    <tr class="totsavprin">
                        <th colspan="8">
                            <button class="btn-sm btn-warning font-weight-bolder my-3 ">SAVE</button>
                            <button class="btn-sm btn-primary btnprint my-3 font-weight-bolder ">PRINT</button> </th>
                    </tr>
                    @endif
                @endif
            @endisset

            
            @isset($searchBranchName)    
                @if(!empty($searchBranchName))
                    @foreach($searchBranchName as $searchName)
                    <tr>
                        <td>{{$no}}</td>
                        <td>{{\Carbon\Carbon::parse($searchName->date)->format('d/m/Y')}}</td>
                        <td>{{$searchName->initiator}}</td>
                        <td>{{$searchName->branch}}</td>
                        <td>{{$searchName->expense_catname}}</td>
                        <td>{{$searchName->description}}</td>
                        <td>
                            <a href="{{ asset("expenseproof/{$searchName->evidence}") }}"" target="blank" id="receipt">View</a>
                        </td>
                        <td id="total"><b>N</b>{{$searchName->amount}}</td>
                        <p class="d-none">{{$no++}}</p>
                    </tr>
                    @endforeach
                    @if($sum !==0)
                        <tr class="totsavprin">
                        <th colspan="2">TOTAL (N)</th><th colspan="6" class="text-right ">{{$sum}}</th>
                    </tr>

                    <tr class="totsavprin">
                        <th colspan="8">
                            <button class="btn-sm btn-warning font-weight-bolder my-3 ">SAVE</button>
                            <button class="btn-sm btn-primary btnprint my-3 font-weight-bolder ">PRINT</button> </th>
                    </tr>
                    @endif
                @endif
            @endisset


            @isset($searchCategory)    
                @if(!empty($searchCategory))
                    @foreach($searchCategory as $searchName)
                    <tr>
                        <td>{{$no}}</td>
                        <td>{{\Carbon\Carbon::parse($searchName->date)->format('d/m/Y')}}</td>
                        <td>{{$searchName->initiator}}</td>
                        <td>{{$searchName->branch}}</td>
                        <td>{{$searchName->expense_catname}}</td>
                        <td>{{$searchName->description}}</td>
                        <td>
                            <a href="{{ asset("expenseproof/{$searchName->evidence}") }}"" target="blank" id="receipt">View</a>
                        </td>
                        <td id="total"><b>N</b>{{$searchName->amount}}</td>
                        <p class="d-none">{{$no++}}</p>
                    </tr>
                    @endforeach
                    @if($sum !==0)
                        <tr class="totsavprin">
                        <th colspan="2">TOTAL (N)</th><th colspan="6" class="text-right ">{{$sum}}</th>
                    </tr>

                    <tr class="totsavprin">
                        <th colspan="8">
                            <button class="btn-sm btn-warning font-weight-bolder my-3 ">SAVE</button>
                            <button class="btn-sm btn-primary btnprint my-3 font-weight-bolder ">PRINT</button> </th>
                    </tr>
                    @endif
                @endif
            @endisset

                    
            @isset($searchNameCategory)    
                @if(!empty($searchNameCategory))
                    @foreach($searchNameCategory as $searchName)
                    <tr>
                        <td>{{$no}}</td>
                        <td>{{\Carbon\Carbon::parse($searchName->date)->format('d/m/Y')}}</td>
                        <td>{{$searchName->initiator}}</td>
                        <td>{{$searchName->branch}}</td>
                        <td>{{$searchName->expense_catname}}</td>
                        <td>{{$searchName->description}}</td>
                        <td>
                            <a href="{{ asset("expenseproof/{$searchName->evidence}") }}"" target="blank" id="receipt">View</a>
                        </td>
                        <td id="total"><b>N</b>{{$searchName->amount}}</td>
                        <p class="d-none">{{$no++}}</p>
                    </tr>
                    @endforeach
                    @if($sum !==0)
                        <tr class="totsavprin">
                        <th colspan="2">TOTAL (N)</th><th colspan="6" class="text-right ">{{$sum}}</th>
                    </tr>

                    <tr class="totsavprin">
                        <th colspan="8">
                            <button class="btn-sm btn-warning font-weight-bolder my-3 ">SAVE</button>
                            <button class="btn-sm btn-primary btnprint my-3 font-weight-bolder ">PRINT</button> </th>
                    </tr>
                    @endif
                @endif
            @endisset

            @isset($searchDateCategory)    
                @if(!empty($searchDateCategory))
                    @foreach($searchDateCategory as $searchName)
                    <tr>
                        <td>{{$no}}</td>
                        <td>{{\Carbon\Carbon::parse($searchName->date)->format('d/m/Y')}}</td>
                        <td>{{$searchName->initiator}}</td>
                        <td>{{$searchName->branch}}</td>
                        <td>{{$searchName->expense_catname}}</td>
                        <td>{{$searchName->description}}</td>
                        <td>
                            <a href="{{ asset("expenseproof/{$searchName->evidence}") }}"" target="blank" id="receipt">View</a>
                        </td>
                        <td id="total"><b>N</b>{{$searchName->amount}}</td>
                        <p class="d-none">{{$no++}}</p>
                    </tr>
                    @endforeach
                    @if($sum !==0)
                        <tr class="totsavprin">
                        <th colspan="2">TOTAL (N)</th><th colspan="6" class="text-right ">{{$sum}}</th>
                    </tr>

                    <tr class="totsavprin">
                        <th colspan="8">
                            <button class="btn-sm btn-warning font-weight-bolder my-3 ">SAVE</button>
                            <button class="btn-sm btn-primary btnprint my-3 font-weight-bolder ">PRINT</button> </th>
                    </tr>
                    @endif
                @endif
            @endisset

            @isset($searchBranchCategory)    
                @if(!empty($searchBranchCategory))
                    @foreach($searchBranchCategory as $searchName)
                    <tr>
                        <td>{{$no}}</td>
                        <td>{{\Carbon\Carbon::parse($searchName->date)->format('d/m/Y')}}</td>
                        <td>{{$searchName->initiator}}</td>
                        <td>{{$searchName->branch}}</td>
                        <td>{{$searchName->expense_catname}}</td>
                        <td>{{$searchName->description}}</td>
                        <td>
                            <a href="{{ asset("expenseproof/{$searchName->evidence}") }}"" target="blank" id="receipt">View</a>
                        </td>
                        <td id="total"><b>N</b>{{$searchName->amount}}</td>
                        <p class="d-none">{{$no++}}</p>
                    </tr>
                    @endforeach
                    @if($sum !==0)
                        <tr class="totsavprin">
                        <th colspan="2">TOTAL (N)</th><th colspan="6" class="text-right ">{{$sum}}</th>
                    </tr>

                    <tr class="totsavprin">
                        <th colspan="8">
                            <button class="btn-sm btn-warning font-weight-bolder my-3 ">SAVE</button>
                            <button class="btn-sm btn-primary btnprint my-3 font-weight-bolder ">PRINT</button> </th>
                    </tr>
                    @endif
                @endif
            @endisset 

            @isset($searchCategoryNameBranch)    
                @if(!empty($searchCategoryNameBranch))
                    @foreach($searchCategoryNameBranch as $searchName)
                    <tr>
                        <td>{{$no}}</td>
                        <td>{{\Carbon\Carbon::parse($searchName->date)->format('d/m/Y')}}</td>
                        <td>{{$searchName->initiator}}</td>
                        <td>{{$searchName->branch}}</td>
                        <td>{{$searchName->expense_catname}}</td>
                        <td>{{$searchName->description}}</td>
                        <td>
                            <a href="{{ asset("expenseproof/{$searchName->evidence}") }}"" target="blank" id="receipt">View</a>
                        </td>
                        <td id="total"><b>N</b>{{$searchName->amount}}</td>
                        <p class="d-none">{{$no++}}</p>
                    </tr>
                    @endforeach
                    @if($sum !==0)
                        <tr class="totsavprin">
                        <th colspan="2">TOTAL (N)</th><th colspan="6" class="text-right ">{{$sum}}</th>
                    </tr>

                    <tr class="totsavprin">
                        <th colspan="8">
                            <button class="btn-sm btn-warning font-weight-bolder my-3 ">SAVE</button>
                            <button class="btn-sm btn-primary btnprint my-3 font-weight-bolder ">PRINT</button> </th>
                    </tr>
                    @endif
                @endif
            @endisset

            @isset($searchCategoryDateBranch)    
                @if(!empty($searchCategoryDateBranch))
                    @foreach($searchCategoryDateBranch as $searchName)
                    <tr>
                        <td>{{$no}}</td>
                        <td>{{\Carbon\Carbon::parse($searchName->date)->format('d/m/Y')}}</td>
                        <td>{{$searchName->initiator}}</td>
                        <td>{{$searchName->branch}}</td>
                        <td>{{$searchName->expense_catname}}</td>
                        <td>{{$searchName->description}}</td>
                        <td>
                            <a href="{{ asset("expenseproof/{$searchName->evidence}") }}"" target="blank" id="receipt">View</a>
                        </td>
                        <td id="total"><b>N</b>{{$searchName->amount}}</td>
                        <p class="d-none">{{$no++}}</p>
                    </tr>
                    @endforeach
                    @if($sum !==0)
                    <tr class="totsavprin">
                        <th colspan="2">TOTAL (N)</th><th colspan="6" class="text-right ">{{$sum}}</th>
                    </tr>

                    <tr class="totsavprin">
                        <th colspan="8">
                            <button class="btn-sm btn-warning font-weight-bolder my-3 ">SAVE</button>
                            <button class="btn-sm btn-primary btnprint my-3 font-weight-bolder ">PRINT</button> </th>
                    </tr>
                    @endif
                @endif
            @endisset

            @isset($searchBranchDateName)    
                @if(!empty($searchBranchDateName))
                    @foreach($searchBranchDateName as $searchName)
                    <tr>
                        <td>{{$no}}</td>
                        <td>{{\Carbon\Carbon::parse($searchName->date)->format('d/m/Y')}}</td>
                        <td>{{$searchName->initiator}}</td>
                        <td>{{$searchName->branch}}</td>
                        <td>{{$searchName->expense_catname}}</td>
                        <td>{{$searchName->description}}</td>
                        <td>
                            <a href="{{ asset("expenseproof/{$searchName->evidence}") }}"" target="blank" id="receipt">View</a>
                        </td>
                        <td id="total"><b>N</b>{{$searchName->amount}}</td>
                        <p class="d-none">{{$no++}}</p>
                    </tr>
                    @endforeach
                    @if($sum !==0)
                        <tr class="totsavprin">
                        <th colspan="2">TOTAL (N)</th><th colspan="6" class="text-right ">{{$sum}}</th>
                    </tr>

                    <tr class="totsavprin">
                        <th colspan="8">
                            <button class="btn-sm btn-warning font-weight-bolder my-3 ">SAVE</button>
                            <button class="btn-sm btn-primary btnprint my-3 font-weight-bolder ">PRINT</button> </th>
                    </tr>
                    @endif
                @endif
            @endisset 

            @isset($searchCategoryDateName)    
                @if(!empty($searchCategoryDateName))
                    @foreach($searchCategoryDateName as $searchName)
                    <tr>
                        <td>{{$no}}</td>
                        <td>{{\Carbon\Carbon::parse($searchName->date)->format('d/m/Y')}}</td>
                        <td>{{$searchName->initiator}}</td>
                        <td>{{$searchName->branch}}</td>
                        <td>{{$searchName->expense_catname}}</td>
                        <td>{{$searchName->description}}</td>
                        <td>
                            <a href="{{ asset("expenseproof/{$searchName->evidence}") }}"" target="blank" id="receipt">View</a>
                        </td>
                        <td id="total"><b>N</b>{{$searchName->amount}}</td>
                        <p class="d-none">{{$no++}}</p>
                    </tr>
                    @endforeach
                    @if($sum !==0)
                        <tr class="totsavprin">
                        <th colspan="2">TOTAL (N)</th><th colspan="6" class="text-right ">{{$sum}}</th>
                    </tr>

                    <tr class="totsavprin">
                        <th colspan="8">
                            <button class="btn-sm btn-warning font-weight-bolder my-3 ">SAVE</button>
                            <button class="btn-sm btn-primary btnprint my-3 font-weight-bolder ">PRINT</button> </th>
                    </tr>
                    @endif
                @endif
            @endisset

            @isset($searchWithAll)    
                @if(!empty($searchWithAll))
                    @foreach($searchWithAll as $searchName)
                    <tr>
                        <td>{{$no}}</td>
                        <td>{{\Carbon\Carbon::parse($searchName->date)->format('d/m/Y')}}</td>
                        <td>{{$searchName->initiator}}</td>
                        <td>{{$searchName->branch}}</td>
                        <td>{{$searchName->expense_catname}}</td>
                        <td>{{$searchName->description}}</td>
                        <td>
                            <a href="{{ asset("expenseproof/{$searchName->evidence}") }}"" target="blank" id="receipt">View</a>
                        </td>
                        <td id="total"><b>N</b>{{$searchName->amount}}</td>
                        <p class="d-none">{{$no++}}</p>
                    </tr>
                    @endforeach
                    @if($sum !==0)
                        <tr class="totsavprin">
                        <th colspan="2">TOTAL (N)</th><th colspan="6" class="text-right ">{{$sum}}</th>
                    </tr>

                    <tr class="totsavprin">
                        <th colspan="8">
                            <button class="btn-sm btn-warning font-weight-bolder my-3 ">SAVE</button>
                            <button class="btn-sm btn-primary btnprint my-3 font-weight-bolder ">PRINT</button> </th>
                    </tr>
                    @endif
                @endif
            @endisset
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $('.btnprint').on('click',function(){
            let printsection = $(this).closest('table').html();
            let printpreview=window.open('', 'PRINT', 'height=600,width=1000');
           // let printpreview=window.open('', '', 'left=0,top=0,width=1000,height=900,toolbar=0,scrollbars=0,status=0');
            printpreview.document.write('<body >');
            printpreview.document.write('<h1 style="text-align:center"> EXPENSES INVENTORY </h1>');
            printpreview.document.write(printsection);
            printpreview.document.write('</body></html>');
           
            printpreview.document.close();
            printpreview.focus();
            printpreview.print();
            printpreview.close();
            })
        });

        // $(function () {
        //     $(".btnprint").DataTable({
        //     "responsive": true, "lengthChange": false, "autoWidth": false,
        //     "buttons": ["copy", "csv", "excel", "pdf", "print"]
        //  }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
   
        // });
</script>