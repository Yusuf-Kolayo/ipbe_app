<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 

class ExpenseController extends Controller
{
    //
    public function allExpensesCatergories(){
        return view ('Admin\expenses');
        
    }
}
