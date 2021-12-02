{{ Form::open(array('url' => route('update_employee_payroll'), 'method' => 'POST', 'class'=>'form form-validate')) }}
        @csrf
        <div class="row">
            <div class="col-12 card py-2">
                <h3><i class="fas fa-cogs mr-2"></i>Edit Payroll</h3>
            </div>
        </div>
        <div class="row mt-3 mx-1">
            <div class="col-12 alert alert-primary my-0">
                <h5>Staff Details</h5>
            </div>
            <div class="col-12">
                <div class="row">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-12">
                                <label for="emp_name">Employee Name</label>
                                    <input id="emp_name" name="employee_name" type="text" class="form-control form-control-sm" readonly="readonly" 
                                        @if($employeePayrollInfo->user->usr_type=='usr_admin')
                                        value="{{ucfirst($employeePayrollInfo->user()->staff->last_name).' '. ucfirst($employeePayrollInfo->user()->staff->first_name)}}"
                                        @else
                                        value="{{ucfirst($employeePayrollInfo->user->agent->agt_last_name).' '. ucfirst($employeePayrollInfo->user->agent->agt_first_name)}}"
                                        @endif    
                                    >
                                </select>

                            </div>
                            <div class="col-12 form-control-wrap">
                                <label for="pay_day">Payment Date</label>
                                <input name="id" type="hidden" class="form-control form-control-sm" required value="{{$employeePayrollInfo->id}}">
                                <input id="pay_day" name="pay_day" type="date" class="form-control form-control-sm" required
                                @if(old('pay_day'))
                                value="{{old('pay_day')}}"
                                @else
                                value="{{$employeePayrollInfo->pay_day}}"
                                @endif 
                                >
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-12">
                                <label for="emp_type">Type of Employee</label>
                                <select class="custom-select custom-select-sm" id="emp_type" name="emp_type"required>
                                    <option class="text-center"> - - SELECT - -</option>
                                    <option value="permanent" 
                                        @if(old('emp_type')== "permanent") selected="selected" @endif 
                                        @if($employeePayrollInfo->employee_type== "permanent") selected="selected" @endif>
                                        Permanent Staff
                                    </option>
                                    
                                    <option value="temporary" 
                                        @if(old('emp_type')== "temporary") selected="selected" @endif
                                        @if($employeePayrollInfo->employee_type== "temporary") selected="selected" @endif>
                                        Temporary Staff
                                    </option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label for="salary">Basic Salary</label>
                                <input type="number" id="salary" name="basic_salary" min="0" 
                                @if(old('basic_salary'))
                                value="{{old('basic_salary')}}"
                                @else
                                value="{{$employeePayrollInfo->salary}}" 
                                @endif
                                class="form-control form-control-sm" required>
                                <div class="d-none row text-center" id="validation">
                                    <div class="col-10 offset-1 alert alert-danger alert-dismissible fade show mb-1 py-1" role="alert" id="showMsg3">
                                        <i class="fas fa-exclamation-triangle pr-1"></i>
                                        <p id="showMsg" class="d-inline-block mb-0"></p>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3 mx-1" id="allowance">
            <div class="col-12 alert alert-primary my-0">
                <h5>Allowance</h5>
            </div>
            <div class="col-12">
                <div class="row">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-12">
                                <label for="rent">House rent</label>
                                <input type="number" id="rent" name="rent" min="0" 
                                @if(old('rent'))
                                value="{{old('rent')}}"
                                @else
                                value="{{$employeePayrollInfo->rent_A}}" 
                                @endif
                                class="form-control form-control-sm">
                            </div>
                            <div class="col-12">
                                <label for="overtime">Overtime</label>
                                <input type="number" id="overtime" name="overtime" min="0"
                                @if(old('overtime'))
                                value="{{old('overtime')}}"
                                @else
                                value="{{$employeePayrollInfo->overtime_A}}" 
                                @endif
                                class="form-control form-control-sm">
                            </div>
                            <div class="col-12">
                                <label for="retire">Retirement</label> 
                                <input type="number" id="retire" name="retire" min="0"
                                @if(old('retire'))
                                value="{{old('retire')}}"
                                @else
                                value="{{$employeePayrollInfo->retire_A}}" 
                                @endif
                                class="form-control form-control-sm">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-12">
                                <label for="med">Medical</label>
                                <input type="number" id="med" name="med" min="0"
                                @if(old('med'))
                                value="{{old('med')}}"
                                @else
                                value="{{$employeePayrollInfo->med_A}}" 
                                @endif
                                class="form-control form-control-sm">
                            </div>
                            <div class="col-12">
                                <label for="convey">Conveyance</label>
                                <input type="number" id="convey" name="convey" min="0"
                                @if(old('convey'))
                                value="{{old('convey')}}"
                                @else
                                value="{{$employeePayrollInfo->convey_A}}" 
                                @endif
                                class="form-control form-control-sm">
                            </div>
                            <div class="col-12">
                                <label for="other">Other</label>
                                <input type="number" id="other" name="other" min="0"
                                @if(old('other'))
                                value="{{old('other')}}"
                                @else
                                value="{{$employeePayrollInfo->other_A}}" 
                                @endif
                                class="form-control form-control-sm">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3 mx-1" id="deduction">
            <div class="col-12 alert alert-primary my-0">
                <h5>Deductions</h5>
            </div>
            <div class="col-12">
                <div class="row">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-12">
                                <label for="tax">Tax</label>
                                <input type="number" id="tax" name="tax" min="0"
                                @if(old('tax'))
                                value="{{old('tax')}}"
                                @else
                                value="{{$employeePayrollInfo->tax_D}}" 
                                @endif
                                class="form-control form-control-sm">
                            </div>
                            <div class="col-12">
                                <label for="pension">Pension plan</label>
                                <input type="number" id="pension" name="pension" min="0"
                                @if(old('pension'))
                                value="{{old('pension')}}"
                                @else
                                value="{{$employeePayrollInfo->pension_D}}" 
                                @endif
                                class="form-control form-control-sm">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-12">
                                <label for="abwork">Absense from work</label>
                                <input type="number" id="abwork" name="abwork" min="0"
                                @if(old('abwork'))
                                value="{{old('abwork')}}"
                                @else
                                value="{{$employeePayrollInfo->ab_work_D}}" 
                                @endif
                                class="form-control form-control-sm">
                            </div>
                            <div class="col-12">
                                <label for="advance">Salary Advance Repayment</label>
                                <input type="number" id="advance" name="advance" min="0"
                                @if(old('advance'))
                                value="{{old('advance')}}"
                                @else
                                value="{{$employeePayrollInfo->advance_D}}" 
                                @endif
                                class="form-control form-control-sm">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3 mx-1" id="finalsalary">
            <div class="col-12 alert alert-primary my-0">
                <h5>Salary Detail <small class="text-muted float-right">you can not edit this section, it is just an overview of everything above</small></h5>
            </div>
            <div class="col-12">
                <div class="row">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-12">
                                <label for="bsalary">Basic  Salary</label>
                                <input type="number" id="bsalary" name="bsalary" min="0" value="0" class="form-control form-control-sm" disabled>
                            </div>
                            <div class="col-12">
                                <label for="allowee">Allowances</label>
                                <input type="number" id="allowee" name="allowee" min="0" value="0" class="form-control form-control-sm" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-12">
                                <label for="deduct">Deduction</label>
                                <input type="number" id="deduct" name="deduct" min="0" value="0" class="form-control form-control-sm" disabled>
                            </div>
                            <div class="col-12">
                                <label for="nsalary">Net Salary</label>
                                <input type="number" id="nsalary" name="nsalary" min="0" value="0" class="form-control form-control-sm" disabled>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3 mx-1">
            <div class="col-6 mt-0 mb-5 ">
                <button type="button" class="btn btn-secondary btn-block btn-sm py-3 font-weight-bolder" data-dismiss="modal">CLOSE</button>
            </div>
            <div class="col-6 mt-0 mb-5 ">
                <input type="submit" class="btn btn-block btn-sm btn-primary py-3 font-weight-bolder" id="savePayroll" value="SAVE">
            </div>
        </div>
        {{ Form::close() }}

        <script type="text/javascript" src="{{ URL::asset('js/jquery-3.5.1.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/popper.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/bootstrap.min.js') }}"></script>

<script type="text/javascript">
    $(document).ready(function() {
        let allowance=0;
        let deduction=0;
        $('#bsalary').val($('#salary').val())
        $("#deduction").find(':input').each(function(){
            deduction += parseInt($(this).val());
            $('#deduct').val(deduction);
        });
        $("#allowance").find(':input').each(function(){
            deduction += parseInt($(this).val());
            $('#allowee').val(deduction);
        });
        let bsalary=parseInt($('#bsalary').val());
        let allDeduct=parseInt($('#deduct').val());
        let allAllowance=parseInt($('#allowee').val());
        let grossIncome=bsalary + allAllowance;
        let netIncome= grossIncome - allDeduct;
        netSalary= $('#nsalary').val(netIncome);
    
        $('form').mouseenter(function(){
            $("#salary").keyup("input", function() {
                if($('#salary').val() > 0){
                    $('#savePayroll').prop("disabled", false);
                    $('#validation').addClass('d-none');
                }
                if ($(this).val()==''){
                        $(this).val(0)
                    }
                $('#bsalary').val($(this).val())
                let bsalary=parseInt($('#bsalary').val());
                let allDeduct=parseInt($('#deduct').val());
                let allAllowance=parseInt($('#allowee').val());
                let grossIncome=bsalary + allAllowance;
                let netIncome= grossIncome - allDeduct;
                netSalary= $('#nsalary').val(netIncome);
            });
            
            $('#allowance').keyup(function(){
                let allowance=0;
                $("#allowance").find(':input').each(function(index,element){
                    if ($(this).val()==''){
                        $(this).val(0)
                    }

                    allowance += parseInt($(this).val());
                    $('#allowee').val(allowance);
                });
                let bsalary=parseInt($('#bsalary').val());
                let allDeduct=parseInt($('#deduct').val());
                let allAllowance=parseInt($('#allowee').val());
                let grossIncome=bsalary + allAllowance;
                let netIncome= grossIncome - allDeduct;
                netSalary= $('#nsalary').val(netIncome);
            })
            $('#deduction').keyup(function(){
                let deduction=0;
                $("#deduction").find(':input').each(function(index,element){
                    if ($(this).val()==''){
                        $(this).val(0)
                    }

                    deduction += parseInt($(this).val());
                    $('#deduct').val(deduction);
                });
                let bsalary=parseInt($('#bsalary').val());
                let allDeduct=parseInt($('#deduct').val());
                let allAllowance=parseInt($('#allowee').val());
                let grossIncome=bsalary + allAllowance;
                let netIncome= grossIncome - allDeduct;
                netSalary= $('#nsalary').val(netIncome);
            })

            $('#savePayroll').mouseenter(function(event){
                if($('#salary').val()< 0){
                    $('#savePayroll').attr('disabled','disabled');
                    $('#validation').removeClass('d-none');
                    $('#showMsg').html('Basic Salary can not be negative');
                }else if($('#salary').val() == 0){
                    $('#savePayroll').attr('disabled','disabled');
                    $('#validation').removeClass('d-none');
                    $('#showMsg').html('Basic Salary can not be zero "0"')
                }
            })
        })
    })
</script>
