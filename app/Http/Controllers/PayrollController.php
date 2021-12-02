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
    //Admin can view all payroll(the function will list all Employee payroll)
    public function payList(){
        $employeePayrollInfo=Payroll::orderBy('created_at','Desc')->get();
        $no=1;
        return view('admin.payroll_list',compact('employeePayrollInfo','no'));
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
            'emp_type'=>'required',
        ]);
        $dateFormat = $req->pay_day;  
        $newDate = date("Y-m-d", strtotime($dateFormat));

        $salary=$req->basic_salary;
        if(strlen($req->basic_salary) > 1){
            if($req->basic_salary[0] == 0){
                $salary=substr($req->basic_salary,1);
            }
        }

        $rentt=$req->rent;
        if(strlen($req->rent) > 1){
            if($req->rent[0] == 0){
                $rentt=substr($req->rent,1);
            }
        }
        
        $medd=$req->med;
        if(strlen($req->med) > 1){
            if($req->med[0] == 0){
                $medd=substr($req->med,1);
            }
        }

        $oTime=$req->overtime;
        if(strlen($req->overtime) > 1){
            if($req->overtime[0] == 0){
                $oTime=substr($req->overtime,1);
            }
        }

        $conveyy=$req->convey;
        if(strlen($req->convey) > 1){
            if($req->convey[0] == 0){
                $conveyy=substr($req->convey,1);
            }
        }

        $retiree=$req->retire;
        if(strlen($req->retire) > 1){
            if($req->retire[0] == 0){
                $retiree=substr($req->retire,1);
            }
        }

        $others=$req->other;
        if(strlen($req->other) > 1){
            if($req->other[0] == 0){
                $others=substr($req->other,1);
            }
        }

        $abWork=$req->abwork;
        if(strlen($req->abwork) > 1){
            if($req->abwork[0] == 0){
                $abWork=substr($req->abwork,1);
            }
        }

        $pen=$req->pension;
        if(strlen($req->pension) > 1){
            if($req->pension[0] == 0){
                $pen=substr($req->pension,1);
            }
        }

        $taxx=$req->tax;
        if(strlen($req->tax) > 1){
            if($req->tax[0] == 0){
                $taxx=substr($req->tax,1);
            }
        }

        $advancee=$req->advance;
        if(strlen($req->advance) > 1){
            if($req->advance[0] == 0){
                $advancee=substr($req->advance,1);
            }
        }
        $newPayroll= new Payroll();
        $newPayroll->employee_id = $req->employee_name;
        $newPayroll->employee_type = $req->emp_type;
        $newPayroll->pay_day = $newDate;
        $newPayroll->salary = $salary;
        $newPayroll->rent_A = $rentt;
        $newPayroll->med_A = $medd;
        $newPayroll->overtime_A = $oTime;
        $newPayroll->convey_A = $conveyy;
        $newPayroll->retire_A = $retiree;
        $newPayroll->other_A = $others;
        $newPayroll->tax_D = $taxx;
        $newPayroll->ab_work_D = $abWork;
        $newPayroll->pension_D = $pen;
        $newPayroll->advance_D = $advancee;
        $savePayroll=$newPayroll->save();

        if($savePayroll){
            return redirect()->back()->with('successful','Payroll has been registered successfully');
        }else{
            return redirect()->back()->with('error','Payroll registration couldn\'t be completed, Try Again !');
        }
        
    }

    //this will return the form to edit each employee payroll record
    public function editEmployeePayrollRecord(Request $req){
        $id=$req['id'];
        $employeePayrollInfo=Payroll::find($id);
        return view('Admin.ajax_return_edit_payroll_form',compact('employeePayrollInfo'));
    }

    //this will save the updated information to db
    public function updateEditedPayroll(Request $req){
        
        $employee_name = $req->old('employee_name');    $emp_type = $req->old('emp_type');
        $pay_day = $req->old('pay_day');                $basic_salary = $req->old('basic_salary');
        $rent = $req->old('rent');                      $med = $req->old('med');
        $overtime = $req->old('overtime');              $convey = $req->old('convey');
        $retire = $req->old('retire');                  $other = $req->old('other');
        $tax = $req->old('tax');                        $abwork = $req->old('abwork');
        $pension = $req->old('pension');                $advance = $req->old('advance');
        
        $req->validate([
            'basic_salary' => 'required',
            'pay_day'=>'required',
        ]);
        $dateFormat = $req->pay_day;  
        $newDate = date("Y-m-d", strtotime($dateFormat));

        $salary=$req->basic_salary;
        if(strlen($req->basic_salary) > 1){
            if($req->basic_salary[0] == 0){
                $salary=substr($req->basic_salary,1);
            }
        }

        $rentt=$req->rent;
        if(strlen($req->rent) > 1){
            if($req->rent[0] == 0){
                $rentt=substr($req->rent,1);
            }
        }
        
        $medd=$req->med;
        if(strlen($req->med) > 1){
            if($req->med[0] == 0){
                $medd=substr($req->med,1);
            }
        }

        $oTime=$req->overtime;
        if(strlen($req->overtime) > 1){
            if($req->overtime[0] == 0){
                $oTime=substr($req->overtime,1);
            }
        }

        $conveyy=$req->convey;
        if(strlen($req->convey) > 1){
            if($req->convey[0] == 0){
                $conveyy=substr($req->convey,1);
            }
        }

        $retiree=$req->retire;
        if(strlen($req->retire) > 1){
            if($req->retire[0] == 0){
                $retiree=substr($req->retire,1);
            }
        }

        $others=$req->other;
        if(strlen($req->other) > 1){
            if($req->other[0] == 0){
                $others=substr($req->other,1);
            }
        }

        $abWork=$req->abwork;
        if(strlen($req->abwork) > 1){
            if($req->abwork[0] == 0){
                $abWork=substr($req->abwork,1);
            }
        }

        $pen=$req->pension;
        if(strlen($req->pension) > 1){
            if($req->pension[0] == 0){
                $pen=substr($req->pension,1);
            }
        }

        $taxx=$req->tax;
        if(strlen($req->tax) > 1){
            if($req->tax[0] == 0){
                $taxx=substr($req->tax,1);
            }
        }

        $advancee=$req->advance;
        if(strlen($req->advance) > 1){
            if($req->advance[0] == 0){
                $advancee=substr($req->advance,1);
            }
        }

        $savePayroll=Payroll::updateOrInsert(
                        ['id' => ($req->id)],
                        [
                            'employee_type' =>($req->emp_type),
                            'pay_day' => ($newDate),
                            'salary' => ($salary),
                            'rent_A' => ($rentt),
                            'med_A' => ($medd),
                            'overtime_A' => ($oTime),
                            'convey_A' => ($conveyy),
                            'retire_A' => ($retiree),
                            'other_A' => ($others),
                            'ab_work_D' => ($abWork),
                            'pension_D' => ($pen),
                            'tax_D' => ($taxx),
                            'advance_D' => ($advancee),
                        ]
                    );
        if($savePayroll){
            return redirect()->back()->with('successful',$req->employee_name.' payroll has been edited successfully');
        }else{
            return redirect()->back()->with('error',$req->employee_name.' payroll couldn\'t be edited, Try Again !');
        }
    }

    public function deleteEmployeePayroll(Request $req){
        $id=$req['id'];

        $deletePayroll=Payroll::find($id)->delete();

        if($deletePayroll){
            return redirect()->back()->with('successful',' Payroll has been deleted successfully');
        }else{
            return redirect()->back()->with('error',' Payroll couldn\'t be deleted, Try Again !');
        }
    }

    public function payrollReport(){
        return view('Admin.payroll_report');
    }
}
