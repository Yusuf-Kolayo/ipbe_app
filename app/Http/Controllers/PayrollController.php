<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 
use App\Models\Client;
use App\Models\User;
use App\Models\Notification;
use App\Models\Payroll;

class PayrollController extends Controller
{
    //Admin can view all payroll(the function will list all pay roll)
    public function payList(){
        return view('admin.payroll_list');
    }

    public function payrollListMonthly(){
        return view('admin.payroll_list_month');
    }

    //this will be use to register new payroll and will populate staff name from DB
    public function payrollAssign(){
        $employee=User::where('usr_type','usr_admin')->orWhere('usr_type','usr_agent')->orderBy('created_at','DESC')->get();
        return view('Admin.payroll_assign',compact('employee'));
    }

    //function save staff payroll in DB
    public function savePayroll(Request $req){
        
        $employee_name = $req->old('employee_name');    $emp_type = $req->old('emp_type');
        $pay_day = $req->old('pay_day');                $basic_salary = $req->old('basic_salary');
        $rent = $req->old('rent');                      $med = $req->old('med');
        $overtime = $req->old('overtime');              $convey = $req->old('convey');
        $retire = $req->old('retire');                  $other = $req->old('other');
        $tax = $req->old('tax');                        $abwork = $req->old('abwork');
        $pension = $req->old('pension');                $advance = $req->old('advance');
        
        $req->validate([
            'employee_name' => 'bail|required|unique:payrolls,employee_id',
            'basic_salary' => 'required',
            'pay_day'=>'required',
        ]);

        $newPayroll= new Payroll();
        $newPayroll->employee_id = $req->employee_name;
        $newPayroll->employee_type = $req->emp_type;
        $newPayroll->pay_day = $req->pay_day;
        $newPayroll->salary = $req->basic_salary;
        $newPayroll->rent_A = $req->rent;
        $newPayroll->med_A = $req->med;
        $newPayroll->overtime_A = $req->overtime;
        $newPayroll->convey_A = $req->convey;
        $newPayroll->retire_A = $req->retire;
        $newPayroll->other_A = $req->other;
        $newPayroll->tax_D = $req->tax;
        $newPayroll->ab_work_D = $req->abwork;
        $newPayroll->pension_D = $req->pension;
        $newPayroll->advance_D = $req->advance;
        $savePayroll=$newPayroll->save();

        if($savePayroll){
            return redirect()->back()->with('successful','Payroll has been registered successfully');
        }else{
            return redirect()->back()->with('error','Payroll registration couldn\'t be completed, Try Agen !');
        }
        
    }

    public function payrollReport(){
        return view('Admin.payroll_report');
    }
}
