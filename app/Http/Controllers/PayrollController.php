<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 
use App\Models\Client;
use App\Models\User;
use App\Models\Notification; 

class PayrollController extends Controller
{
    //Admin can view all payroll(the function will list all pay roll)
    public function payList(){
        return view('admin.payroll_list');
    }

    public function payrollListMonthly(){
        return view('admin.payroll_list_month');
    }
}
