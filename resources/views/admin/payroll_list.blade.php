@extends('layouts.main')

@section('content')
@if (session('successful'))
    <div class="alert alert-success alert-dismissible fade show mb-1 py-1" role="alert">
        <p class="text-center">{{ session('successful') }}</p>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
@if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show mb-1 py-1" role="alert">
        <p class="text-center">{{ session('error') }}</p>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
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
                <tr class="maintr">
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
                                    <li>
                                        <a href="#" data-toggle="modal" data-target="#payrollAction" data-action="payPayroll" data-id="{{$employee->id}}">
                                            <i class="fab fa-cc-amazon-pay mr-2"></i>
                                            <span>PAY</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" data-toggle="modal" data-target="#payrollAction" data-action="editPayroll" data-id="{{$employee->id}}">
                                            <i class="fas fa-user-cog mr-2"></i>
                                            <span>EDIT</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" data-toggle="modal" data-target="#payrollAction" data-action="deletePayroll" data-id="{{$employee->id}}">
                                            <i class="fas fa-trash-alt mr-2"></i>
                                            <span>DELETE</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" data-toggle="modal" data-target="#payrollAction" data-action="summaryPayroll" data-id="{{$employee->id}}">
                                            <i class="fas fa-list-ul mr-2"></i>
                                            <span>SUMMARY</span>
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
<div class="modal fade" id="payrollAction" tabindex="-1" role="dialog" aria-labelledby="payrollaction" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <p class="modal-title font-weight-bold d-inline-block" id="payrollaction"></p>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="d-flex justify-content-center">  
                    <div class="spinner-border" role="status"> 
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-block btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div id="confirmDelete" class="d-none">
    <div class="row card">
        {{ Form::open(array('url' => route('delete_employee_payroll'), 'method' => 'POST', 'class'=>'form form-validate')) }}
        @csrf
        <input type="hidden" name="id" id="id">
        <div class="col-12 text-center"><h5>Are you sure you want to delete this payroll record ?</h5></div>
        <div class="row mt-2">
            <div class="col-6"><button type="button" class="btn btn-secondary btn-block btn-sm" data-dismiss="modal">EXIT</button></div>
            <div class="col-6"><button type="submit" class="btn btn-primary btn-block btn-sm" id="delete">DELETE</button></div>
        </div>
        {{ Form::close() }}
    </div>
</div>

<script type="text/javascript" src="{{ URL::asset('js/jquery-3.5.1.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/popper.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/bootstrap.min.js') }}"></script>

<script type="text/javascript">
    $(document).ready(function(){
        $('#payrollAction').on('shown.bs.modal', function (event) {
            let button = $(event.relatedTarget) //get the element that trigger the modal
            let recipient = button.data('action') // Extract info from data-action
            let modal=$(this);
                if(recipient=='payPayroll'){

                }else if(recipient=='editPayroll'){
                    let payrollId=button.data('id');
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content')
                        },
                        type:'get',
                        dataType:'text',
                        data:{'id':payrollId},
                        url:"{{route('edit_employee_payroll')}}",
                        success:function(success){
                            modal.find('.modal-header').remove();
                            modal.find('.modal-footer').remove();
                            modal.find('.modal-body').html(success);
                        },
                        error:function(error){
                            console.log(error);
                        }
                    })
                }else if(recipient=='deletePayroll'){
                    let payrollId=button.data('id');
                    modal.find('.modal-header').remove();
                    modal.find('.modal-footer').remove();
                    let deleteOption=$('#confirmDelete').html();
                    modal.find('.modal-body').html(deleteOption);
                    $('input[name=id]').val(payrollId);
                }else{

                }
        })
        
    })
</script>
@endsection