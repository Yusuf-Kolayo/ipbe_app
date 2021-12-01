@extends('layouts.main')

@section('content')
<div class="container-fluid table-responsive">
    <table id="example" class="datatable-init table table-sm table-bordered table-striped display nowrap">
        <thead class="thead">
            <tr>
                <th>SL</th>
                <th>Employee Name</th>
                <th>Designation</th>
                <th>Employee Type</th>
                <th>Basic Salary</th>
                <th>Allowance</th>
                <th>Deductions</th>
                <th>Net Salary</th>
                <th class="text-center">Actions</th>
            </tr>
        </thead>
            <tbody class="t-body" >
                @foreach($employeePayrollInfo as $employee)
                <tr>
                    <td>{{$no}}</td>
                    <td>
                    @if($employee->user->usr_type=='usr_admin')
                        {{ucfirst($employee->user->staff->last_name).' '. ucfirst($employee->user->staff->first_name)}}
                    @else
                        {{ucfirst($employee->user->agent->agt_last_name).' '. ucfirst($employee->user->agent->agt_first_name)}}
                    @endif
                    </td>
                    <td>
                        @if($employee->user->usr_type=='usr_admin')
                            Administrator
                        @else
                            Agent
                        @endif
                    </td>
                    <td>{{$employee->employee_type}}</td>
                    <td><b class="mr-1">NGN</b>{{$employee->salary}}</td>
                    <?php
                    $allowance=$employee->rent_A + $employee->med_A + $employee->overtime_A + $employee->convey_A + $employee->retire_A + $employee->other_A;
                    $deduction=$employee->tax_D + $employee->ab_work_D + $employee->pension_D + $employee->advance_D;
                    $net_salary= ($employee->salary + $allowance) - $deduction
                    ?>
                    <td><b class="mr-1">NGN</b>{{$allowance}}</td>
                    <td><b class="mr-1">NGN</b>{{$deduction}}</td>
                    <td><b class="mr-1">NGN</b>{{$net_salary}}</td>
                    <td class="text-center">
                        <div class="dropdown">
                            <a href="#" class="dropdown-toggle btn btn-icon btn-trigger mr-n1" data-toggle="dropdown" aria-expanded="false">
                                <em class="icon ni ni-more-h"></em>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <ul class="link-list-opt no-bdr">
                                    <li data-toggle="modal" data-target="#payPayrollModal">
                                        <a href="#"><i class="fab fa-cc-amazon-pay mr-2"></i>
                                            <span>PAY</span>
                                        </a>
                                    </li>
                                    <li data-toggle="modal" data-target="#editPayrollModal">
                                        <a href="#"><i class="fas fa-user-cog mr-2"></i>
                                            <span>EDIT</span>
                                        </a>
                                    </li>
                                    
                                    <li data-toggle="modal" data-target="#summaryPayrollModal">
                                        <a href="#"><i class="fas fa-list-ul mr-2"></i>
                                            <span>SUMMARY</span>
                                        </a>
                                    </li>
                                    <li data-toggle="modal" data-target="#deletePayrollModal">
                                        <a href="#"><i class="fas fa-trash-alt mr-2"></i>
                                            <span>DELETE</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </td>
                </tr>
                <?php $no++ ?>
                @endforeach
            </tbody>
    </table>
</div>

  
<!-- Modal for payroll action -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
@endsection