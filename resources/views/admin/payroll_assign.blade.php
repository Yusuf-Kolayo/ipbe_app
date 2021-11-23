@extends('layouts.main')
@section('content')

<div class="container-fluid card">
    <div class="row">
        <div class="col-12 card py-2">
            <h3><i class="fas fa-cogs mr-2"></i>Payroll Setup</h3>
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
                            <select class="custom-select custom-select-sm">
                                <option>--Employee Name--</option>
                                <option value="olamide">Olaniyi Olamide</option>
                                <option value="omotoyosi">Odeyeyiwa Omotoyosi</option>
                                <option value="adedayo">Balogun Adedayo</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label for="pay_day">Payment Date</label>
                            <input id="pay_day" name="pay_day" type="date" class="form-control form-control-sm">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-12">
                            <label for="emp_type">Type of Employee</label>
                            <input id="emp_type" name="emp_type" type="text" class="form-control form-control-sm">
                        </div>
                        <div class="col-12">
                            <label for="salary">Basic Salary</label>
                            <input id="salary" name="salary" type="text" class="form-control form-control-sm">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-3 mx-1">
        <div class="col-12 alert alert-primary my-0">
            <h5>Allowance</h5>
        </div>
        <div class="col-12">
            <div class="row">
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-12">
                            <label for="emp_name">House rent</label>
                            <select class="custom-select custom-select-sm">
                                <option>--Employee Name--</option>
                                <option value="olamide">Olaniyi Olamide</option>
                                <option value="omotoyosi">Odeyeyiwa Omotoyosi</option>
                                <option value="adedayo">Balogun Adedayo</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label for="pay_day">Overtime</label>
                            <input id="pay_day" name="pay_day" type="date" class="form-control form-control-sm">
                        </div>
                        <div class="col-12">
                            <label for="pay_day">Retirement</label>
                            <input id="pay_day" name="pay_day" type="date" class="form-control form-control-sm">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-12">
                            <label for="emp_type">Medical</label>
                            <input id="emp_type" name="emp_type" type="text" class="form-control form-control-sm">
                        </div>
                        <div class="col-12">
                            <label for="salary">Conveyance</label>
                            <input id="salary" name="salary" type="text" class="form-control form-control-sm">
                        </div>
                        <div class="col-12">
                            <label for="pay_day">Other</label>
                            <input id="pay_day" name="pay_day" type="date" class="form-control form-control-sm">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-3 mx-1">
        <div class="col-12 alert alert-primary my-0">
            <h5>Deductions</h5>
        </div>
        <div class="col-12">
            <div class="row">
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-12">
                            <label for="tax">Tax</label>
                            <input type="number" id="tax" name="tax" max="0" value="0" class="form-control form-control-sm">
                        </div>
                        <div class="col-12">
                            <label for="pension">Pension plan</label>
                            <input type="number" id="pension" name="pension" max="0" value="0" class="form-control form-control-sm">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-12">
                            <label for="abwork">Absense from work</label>
                            <input type="number" id="abwork" name="abwork" max="0" value="0" class="form-control form-control-sm">
                        </div>
                        <div class="col-12">
                            <label for="advance">Salary Advance Repayment</label>
                            <input type="number" id="advance" name="advance" max="0" value="0" class="form-control form-control-sm">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-3 mx-1">
        <div class="col-12 alert alert-primary my-0">
            <h5>Salary Detail</h5>
        </div>
        <div class="col-12">
            <div class="row">
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-12">
                            <label for="emp_name">Basic  Salary</label>
                            
                        </div>
                        <div class="col-12">
                            <label for="pay_day">Allowances</label>
                            <input id="pay_day" name="pay_day" type="date" class="form-control form-control-sm">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-12">
                            <label for="emp_type">Deduction</label>
                            <input id="emp_type" name="emp_type" type="text" class="form-control form-control-sm">
                        </div>
                        <div class="col-12">
                            <label for="salary">Net Salary</label>
                            <input id="salary" name="salary" type="text" class="form-control form-control-sm">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-3 mx-1">
        <div class="col-12 mt-0 mb-5 ">
            <h3 class="btn btn-block btn-sm btn-primary py-3 font-weight-bolder">SAVE</h3>
        </div>
    </div>
</div>
@endsection