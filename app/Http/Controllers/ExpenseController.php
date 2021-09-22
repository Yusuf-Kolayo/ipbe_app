<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 
use App\Models\Expense;
use App\Models\Expenses_category;

class ExpenseController extends Controller
{
    // EXPENSES CATEGORY FUNCTION
     
    public function allExpensesCatergories(){
        //this category function loads all expenses category created
        $data=Expenses_category::orderBy('expense_catname', 'ASC')->get();
        $no=1;
        return view('Admin\expenseseditcat',['data'=>$data,'no'=>$no]);    
    }
        
    public function newExpensesCatgory(Request $cat){
    //this category function saves any new category created
        $this->validate($cat,[
            'cat_name'=>'required',
        ]);
        // save to database
        $catname = new Expenses_category();
        
        //On left field name in DB and on right field name in Form/view
        $catname->expense_catname = $cat->cat_name;
        $catname->save();
        $name=$cat->cat_name;
    
        return redirect()->back()->with('status',$name.' Added Successfully');
    }

   public function editExpensesCatergory(Request $req){
        //this category edits any category name already created
        $id = $req['id'];
        $catName=$req['catName'];
        $data=Expenses_category::find($id);
        $data->expense_catname=$catName;
        $data->save();
        return redirect()->back()->with('statuss',$catName.' Successfully Changed');   
    }
    
        //this category function deletes expenses category name
    public function deleteExpensesCatergory($id){
        $data=Expenses_category::find($id);
        $data->delete();
        return redirect()->back()->with('status','Deleted Successfully');

    }


     // EXPENSES  FUNCTION

    public function addNewExpenses(){
        //this will return saved expenses category into the select option
        $data= Expenses_category::orderBy('expense_catname', 'ASC')->get();
        return view ('Admin\expensesnew',['category'=>$data]);
    }
     

    public function saveExpenses(Request $exp){
        //this will save any new expenses inputed
        $this->validate($exp,[
            'date'=>'required',
            'name'=>'required',
            'cat_name'=>'required',
            'branch'=>'required',
            'amount'=>'required',
            'proof'=>'required',
            'desc'=>'required',

        ]);
    if($proofOfExpense=$exp->file('proof')){
        $proofName=$proofOfExpense->getClientOriginalName();
            if($proofOfExpense->move('expenseproof',$proofName)){
                $expenseSave = new Expense();
                //On left field name in DB and on right field name in Form/view
                $expenseSave->date = $exp->input('date');
                $expenseSave->initiator = $exp->input('name');
                $expenseSave->cat_id = $exp->input('cat_name');
                $expenseSave->branch = $exp->input('branch');
                $expenseSave->amount = $exp->input('amount');
                $expenseSave->evidence = $proofName;
                $expenseSave->description = $exp->input('desc');
                $expenseSave->save();
                return redirect('/company/expenses/all');
            }
    }
        return redirect()->back();
        
    }

    public function expensesPrint(){
        return view ('Admin\expensesprint');
    }


    public function allExpenses(){
        //this will return all list of expenses
        $allExpense=Expense::join('expenses_categories','expenses.cat_id','=','expenses_categories.id')
        ->orderBy('date', 'DESC')
        ->get();
        $no=1;
        return view ('Admin\expenses',['Expense'=>$allExpense,'no'=>$no]) ;
       
    }

    public function deleteExpenses(Request $req){
        //this will delete a particular expenses
        $expense_id=$req['expense_id'];
        DB::table('expenses')->where('expense_id', $expense_id)->delete();
        //echo "successful";
        return redirect()->back();
    }

    public function searchName(Request $req){
        //this function will search for expenses with a particular name
        $no=1;
        $initiator=$req['initiator'];
        
        $result=DB::table('expenses')
        ->join('expenses_categories','expenses.cat_id','=','expenses_categories.id')
        ->where('initiator', $initiator)
        ->orderBy('date', 'DESC')
        ->get();

        $sum=DB::table('expenses')
        ->join('expenses_categories','expenses.cat_id','=','expenses_categories.id')
        ->where('initiator', $initiator)
        ->orderBy('date', 'DESC')
        ->sum('amount');

        return view ('Admin\expense_search_result',['searchName'=>$result,'no'=>$no,'sum'=>$sum]);
    //return redirect()->route('expenses_print',['searchName'=>$result]);
    }

    public function searchBranch(Request $req){
        //this function will search for expenses with a particular name
        $no=1;
        $branch=$req['branch'];
       
        $result=DB::table('expenses')
        ->join('expenses_categories','expenses.cat_id','=','expenses_categories.id')
        ->where('branch', $branch)
        ->orderBy('date', 'DESC')
        ->get();
        
        $sum=DB::table('expenses')
        ->join('expenses_categories','expenses.cat_id','=','expenses_categories.id')
        ->where('branch', $branch)
        ->orderBy('date', 'DESC')
        ->sum('amount');
        
        return view ('Admin\expense_search_result',['searchBranch'=>$result,'no'=>$no,'sum'=>$sum]);
    }

    public function searchDate(Request $req){
        $no=1;
        $from=$req['fromDate'];
        $to=$req['toDate'];
        
        $result=DB::table('expenses')
        ->join('expenses_categories','expenses.cat_id','=','expenses_categories.id')
        ->whereBetween('date', [$from, $to])
        ->orderBy('date', 'DESC')
        ->get();

        $sum=DB::table('expenses')
        ->join('expenses_categories','expenses.cat_id','=','expenses_categories.id')
        ->whereBetween('date', [$from, $to])
        ->orderBy('date', 'DESC')
        ->sum('amount');

        
        return view ('Admin\expense_search_result',['searchDate'=>$result,'no'=>$no,'sum'=>$sum]);
    }
    public function searchDateAndBranch(Request $req){
        $no=1;
        $from=$req['fromDate'];
        $to=$req['toDate'];
        $branch=$req['branch'];
        
        $result=DB::table('expenses')
        ->join('expenses_categories','expenses.cat_id','=','expenses_categories.id')
        ->whereBetween('date', [$from, $to],)
        ->where('branch', [$branch])
        ->orderBy('date', 'DESC')
        ->get();

        $sum=DB::table('expenses')
        ->join('expenses_categories','expenses.cat_id','=','expenses_categories.id')
        ->whereBetween('date', [$from, $to],)
        ->where('branch', [$branch])
        ->orderBy('date', 'DESC')
        ->sum('amount');

        return view ('Admin\expense_search_result',['searchDateBranch'=>$result,'no'=>$no,'sum'=>$sum]); 
    }
    public function searchDateAndName(Request $req){
        $no=1;
        $from=$req['fromDate'];
        $to=$req['toDate'];
        $initiator=$req['initiator'];

        $result=DB::table('expenses')
        ->join('expenses_categories','expenses.cat_id','=','expenses_categories.id')
        ->whereBetween('date', [$from, $to],)
        ->where('initiator', [$initiator])
        ->orderBy('date', 'DESC')
        ->get();

        $sum=DB::table('expenses')
        ->join('expenses_categories','expenses.cat_id','=','expenses_categories.id')
        ->whereBetween('date', [$from, $to],)
        ->where('initiator', [$initiator])
        ->orderBy('date', 'DESC')
        ->sum('amount');

        return view ('Admin\expense_search_result',['searchDateName'=>$result,'no'=>$no,'sum'=>$sum]); 
    }
    public function searchBranchAndName(Request $req){
        $no=1;
        $branch=$req['branch'];
        $initiator=$req['initiator'];
        
        $result=DB::table('expenses')
        ->join('expenses_categories','expenses.cat_id','=','expenses_categories.id')
        ->where('branch', $branch,)
        ->where('initiator', [$initiator])
        ->orderBy('date', 'DESC')
        ->get();

        $sum=DB::table('expenses')
        ->join('expenses_categories','expenses.cat_id','=','expenses_categories.id')
        ->where('branch', $branch,)
        ->where('initiator', [$initiator])
        ->orderBy('date', 'DESC')
        ->sum('amount');

        return view ('Admin\expense_search_result',['searchBranchName'=>$result,'no'=>$no,'sum'=>$sum]); 
    }

    public function searchWithAll(Request $req){
        $no=1;
        $from=$req['fromDate'];
        $to=$req['toDate'];
        $branch=$req['branch'];
        $initiator=$req['initiator'];
        
        $result=DB::table('expenses')
        ->join('expenses_categories','expenses.cat_id','=','expenses_categories.id')
        ->whereBetween('date', [$from, $to],)
        ->where('branch', $branch,)
        ->where('initiator', [$initiator])
        ->orderBy('date', 'DESC')
        ->get();

        $sum=DB::table('expenses')
        ->join('expenses_categories','expenses.cat_id','=','expenses_categories.id')
        ->whereBetween('date', [$from, $to],)
        ->where('branch', $branch,)
        ->where('initiator', [$initiator])
        ->orderBy('date', 'DESC')
        ->sum('amount');

        return view ('Admin\expense_search_result',['searchWithAll'=>$result,'no'=>$no,'sum'=>$sum]); 
    }
    
}
