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
                <thead>
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