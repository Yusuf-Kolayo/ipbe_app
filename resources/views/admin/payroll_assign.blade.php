@extends('layouts.main')
@section('content')

<div class="container-fluid card">
    <form class="form">
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
                                <input type="number" id="salary" name="salary" min="0" value="0" class="form-control form-control-sm">
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
                                <input type="number" id="rent" name="rent" min="0" value="0" class="form-control form-control-sm">
                            </div>
                            <div class="col-12">
                                <label for="overtime">Overtime</label>
                                <input type="number" id="overtime" name="overtime" min="0" value="0" class="form-control form-control-sm">
                            </div>
                            <div class="col-12">
                                <label for="retire">Retirement</label>
                                <input type="number" id="retire" name="retire" min="0" value="0" class="form-control form-control-sm">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-12">
                                <label for="med">Medical</label>
                                <input type="number" id="med" name="med" min="0" value="0" class="form-control form-control-sm">
                            </div>
                            <div class="col-12">
                                <label for="convey">Conveyance</label>
                                <input type="number" id="convey" name="convey" min="0" value="0" class="form-control form-control-sm">
                            </div>
                            <div class="col-12">
                                <label for="other">Other</label>
                                <input type="number" id="other" name="other" min="0" value="0" class="form-control form-control-sm">
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
                                <input type="number" id="tax" name="tax" min="0" value="0" class="form-control form-control-sm">
                            </div>
                            <div class="col-12">
                                <label for="pension">Pension plan</label>
                                <input type="number" id="pension" name="pension" min="0" value="0" class="form-control form-control-sm">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-12">
                                <label for="abwork">Absense from work</label>
                                <input type="number" id="abwork" name="abwork" min="0" value="0" class="form-control form-control-sm">
                            </div>
                            <div class="col-12">
                                <label for="advance">Salary Advance Repayment</label>
                                <input type="number" id="advance" name="advance" min="0" value="0" class="form-control form-control-sm">
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
                                <label for="bsalary">Basic  Salary</label>
                                <input type="number" id="bsalary" name="bsalary" min="0" value="0" class="form-control form-control-sm">
                            </div>
                            <div class="col-12">
                                <label for="allowee">Allowances</label>
                                <input type="number" id="allowee" name="allowee" min="0" value="0" class="form-control form-control-sm">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-12">
                                <label for="deduct">Deduction</label>
                                <input type="number" id="deduct" name="deduct" min="0" value="0" class="form-control form-control-sm">
                            </div>
                            <div class="col-12">
                                <label for="nsalary">Net Salary</label>
                                <input type="number" id="nsalary" name="nsalary" min="0" value="0" class="form-control form-control-sm">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3 mx-1">
            <div class="col-12 mt-0 mb-5 ">
                <input type="submit" class="btn btn-block btn-sm btn-primary py-3 font-weight-bolder" value="SAVE">
            </div>
        </div>
    </form>
</div>

<script type="text/javascript" src="{{ URL::asset('js/jquery-3.5.1.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/popper.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/bootstrap.min.js') }}"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('form').mouseenter(function(){
            $("#salary").on("input", function() {
                $('#bsalary').val($(this).val()) 
            });

            let med =$('#med').val();
            console.log(med);
            $( "input[name='med']" ).change(function (){
                if(med !== $(this).val()){
                    let med =$(this).val();
                    console.log(med);

                }
            })

            
            
            $("#overtime").on("input", function() {
                let overtime =$(this).val();
            });
            $("#rent").on("input", function() {
                let rent =$(this).val();
            });
            $("#retire").on("input", function() {
                let retire =$(this).val();
            });
            $("#convey").on("input", function() {
                let convey =$(this).val();
            });
            $("#other").on("input", function() {
                let other =$(this).val();
            });
            
            let deduction= med+overtime+rent+retire+convey+other;
            
            
            // $("#deduction").each(function(){
            //     $(this).find(':input') //<-- Should return all input elements in that specific form.
            // });
            
        })
    });
</script>
@endsection