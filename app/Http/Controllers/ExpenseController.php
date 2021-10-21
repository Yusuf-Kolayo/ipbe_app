<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Facades\Auth; 
use App\Models\Access_permission;  
use App\Models\Expense;
use App\Models\Expenses_category;

class ExpenseController extends BaseController
{
    // EXPENSES CATEGORY FUNCTION 


    public $middleware_except;   public $title = 'expense';


    public function __construct() {
       $this->middleware('auth');
       parent::__construct();
       
       $this->middleware(function ($request, $next) {    
        $user_id= Auth::user()->user_id;   $usr_type = Auth::user()->usr_type;
        if ($usr_type=='usr_admin') { $permitted_sections = array(); // dd('here');
        
        $user_permissions = Access_permission::Where(['user_id'=>$user_id, 'title'=>$this->title])->get();  //dd($user_permissions);
        foreach ($user_permissions as $key => $permission) {
            $permitted_sections[]  = $permission->section; 
        }    

        // $permitted_sections = substr($permitted_sections,0,-1);
        $this->middleware_except = $permitted_sections;
     
        }
        
        return $next($request);
       });

    }

     
    public function allExpensesCatergories() {

        $section = 'allExpensesCatergories';   // dd($this->middleware_except);  
        if (auth()->user()->usr_type=='usr_admin') {
            if (in_array($section, $this->middleware_except)) {

        // this category function loads all expenses category created
        $data=Expenses_category::orderBy('expense_catname', 'ASC')->get();   $no=1;
        return view('Admin\expenseseditcat',['data'=>$data,'no'=>$no]);
            } else {  return redirect()->route('access_denied'); }
        }
    }
        
    public function newExpensesCatgory(Request $cat){

        $section = 'newExpensesCatgory';   // dd($this->middleware_except);  
        if (auth()->user()->usr_type=='usr_admin') {
            if (in_array($section, $this->middleware_except)) {


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
        } else {  return redirect()->route('access_denied'); }
        }
    }

    public function editExpensesCatergory(Request $req) {

        $section = 'editExpensesCatergory';   // dd($this->middleware_except);  
        if (auth()->user()->usr_type=='usr_admin') {
            if (in_array($section, $this->middleware_except)) {

        //this category edits any category name already created
        $id = $req['id'];
        $catName=$req['catName'];
        $data=Expenses_category::find($id);
        $data->expense_catname=$catName;
        $data->save();
        echo('Category name changed successfully');
        //return redirect()->back();   
            } else {  return redirect()->route('access_denied');  }
        }
    }
    
    //this category function deletes expenses category name
    public function deleteExpensesCatergory($id) {

        $section = 'deleteExpensesCatergory';   // dd($this->middleware_except);  
        if (auth()->user()->usr_type=='usr_admin') {
            if (in_array($section, $this->middleware_except)) {

        $data=Expenses_category::find($id);
        $data->delete();
        //return redirect()->back()->with('status','Deleted Successfully');
        echo('Deleted Successfully'); 
        } else {  return redirect()->route('access_denied'); }
        }
    }

     // EXPENSES  FUNCTION 
    public function addNewExpenses() {
        $section = 'addNewExpenses';   // dd($this->middleware_except);  
        if (auth()->user()->usr_type=='usr_admin') {
            if (in_array($section, $this->middleware_except)) {

        //this will return saved expenses category into the select option
        $data= Expenses_category::orderBy('expense_catname', 'ASC')->get();
        return view ('Admin\expensesnew',['category'=>$data]);
        } else {  return redirect()->route('access_denied');  }
        }
    }
     

    public function saveExpenses(Request $exp) {

        $section = 'saveExpenses';   // dd($this->middleware_except);  
        if (auth()->user()->usr_type=='usr_admin') {
            if (in_array($section, $this->middleware_except)) {

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
       } else { return redirect()->route('access_denied'); }
       }
        
    }

    public function expensesPrint() {
        $section = 'expensesPrint';   // dd($this->middleware_except);  
        if (auth()->user()->usr_type=='usr_admin') {
            if (in_array($section, $this->middleware_except)) {

        $category=Expenses_category::orderBy('expense_catname', 'ASC')->get();
        return view ('Admin\expensesprint',['category'=>$category]);
        } else {  return redirect()->route('access_denied'); }
    }
    }


    public function allExpenses(){
        $section = 'allExpenses';   // dd($this->middleware_except);  
        if (auth()->user()->usr_type=='usr_admin') {
            if (in_array($section, $this->middleware_except)) {

        //this will return all list of expenses
        $allExpense=Expense::join('expenses_categories','expenses.cat_id','=','expenses_categories.id')
        ->orderBy('date', 'DESC')
        ->get();

        $category=Expenses_category::orderBy('expense_catname', 'ASC')->get();

        $no=1;
        return view ('Admin\expenses',['Expense'=>$allExpense,'no'=>$no,'category'=>$category]) ; 
        } else { return redirect()->route('access_denied'); }
        }
    }

    public function deleteExpenses(Request $req){

        $section = 'deleteExpenses';   // dd($this->middleware_except);  
        if (auth()->user()->usr_type=='usr_admin') {
            if (in_array($section, $this->middleware_except)) {

        //this will delete a particular expenses
        $expense_id=$req['expense_id'];
        DB::table('expenses')->where('expense_id', $expense_id)->delete();
        //echo "successful";
        return redirect()->back();
        } else { return redirect()->route('access_denied'); }
        }
    }

    public function searchName(Request $req) {

        $section = 'searchName';   // dd($this->middleware_except);  
        if (auth()->user()->usr_type=='usr_admin') {
            if (in_array($section, $this->middleware_except)) {

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
        } else { return redirect()->route('access_denied'); }
        }
    }

    public function searchBranch(Request $req) {

        $section = 'searchBranch';   // dd($this->middleware_except);  
        if (auth()->user()->usr_type=='usr_admin') {
            if (in_array($section, $this->middleware_except)) {

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
        } else { return redirect()->route('access_denied'); }
        }
    }

    public function searchDate(Request $req) {

        $section = 'searchDate';   // dd($this->middleware_except);  
        if (auth()->user()->usr_type=='usr_admin') {
            if (in_array($section, $this->middleware_except)) {

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
        } else { return redirect()->route('access_denied'); }
        }
    }

    public function searchCategory(request $req) {    
    
        $section = 'searchCategory';   // dd($this->middleware_except);  
        if (auth()->user()->usr_type=='usr_admin') {
            if (in_array($section, $this->middleware_except)) {

        $no=1;
        $category=$req['category'];
       
        $result=DB::table('expenses')
        ->join('expenses_categories','expenses.cat_id','=','expenses_categories.id')
        ->where('expense_catname', $category)
        ->orderBy('date', 'DESC')
        ->get();
        
        $sum=DB::table('expenses')
        ->join('expenses_categories','expenses.cat_id','=','expenses_categories.id')
        ->where('expense_catname', $category)
        ->orderBy('date', 'DESC')
        ->sum('amount');
        
        return view ('Admin\expense_search_result',['searchCategory'=>$result,'no'=>$no,'sum'=>$sum]);
        } else { return redirect()->route('access_denied'); }
        }
    }

    public function searchCategoryAndName(request $req){

        $section = 'searchCategoryAndName';   // dd($this->middleware_except);  
        if (auth()->user()->usr_type=='usr_admin') {
            if (in_array($section, $this->middleware_except)) {

        $no=1;
        $category=$req['category'];
        $initiator=$req['initiator'];
       
        $result=DB::table('expenses')
        ->join('expenses_categories','expenses.cat_id','=','expenses_categories.id')
        ->where('expense_catname', $category)
        ->where('initiator', [$initiator])
        ->orderBy('date', 'DESC')
        ->get();
        
        $sum=DB::table('expenses')
        ->join('expenses_categories','expenses.cat_id','=','expenses_categories.id')
        ->where('expense_catname', $category)
        ->where('initiator', [$initiator])
        ->orderBy('date', 'DESC')
        ->sum('amount');
        
        return view ('Admin\expense_search_result',['searchNameCategory'=>$result,'no'=>$no,'sum'=>$sum]);
        } else { return redirect()->route('access_denied'); }
        }
    }

    public function searchCategoryAndDate(request $req){

        $section = 'searchCategoryAndDate';   // dd($this->middleware_except);  
        if (auth()->user()->usr_type=='usr_admin') {
            if (in_array($section, $this->middleware_except)) {

        $no=1;
        $category=$req['category'];
        $from=$req['fromDate'];
        $to=$req['toDate'];
       
        $result=DB::table('expenses')
        ->join('expenses_categories','expenses.cat_id','=','expenses_categories.id')
        ->whereBetween('date', [$from, $to],)
        ->where('expense_catname', [$category])
        ->orderBy('date', 'DESC')
        ->get();

        $sum=DB::table('expenses')
        ->join('expenses_categories','expenses.cat_id','=','expenses_categories.id')
        ->whereBetween('date', [$from, $to],)
        ->where('expense_catname', [$category])
        ->orderBy('date', 'DESC')
        ->sum('amount');
        
        return view ('Admin\expense_search_result',['searchDateCategory'=>$result,'no'=>$no,'sum'=>$sum]);

        } else { return redirect()->route('access_denied'); }
        }
    }

    public function searchCategoryAndBranch(request $req){

        $section = 'searchCategoryAndBranch';   // dd($this->middleware_except);  
        if (auth()->user()->usr_type=='usr_admin') {
            if (in_array($section, $this->middleware_except)) {

        $no=1;
        $category=$req['category'];
        $branch= $req['branch'];

        $result=DB::table('expenses')
        ->join('expenses_categories','expenses.cat_id','=','expenses_categories.id')
        ->where('branch', [$branch])
        ->where('expense_catname', [$category])
        ->orderBy('date', 'DESC')
        ->get();

        $sum=DB::table('expenses')
        ->join('expenses_categories','expenses.cat_id','=','expenses_categories.id')
        ->where('branch', [$branch])
        ->where('expense_catname', [$category])
        ->orderBy('date', 'DESC')
        ->sum('amount');
        
        return view ('Admin\expense_search_result',['searchBranchCategory'=>$result,'no'=>$no,'sum'=>$sum]);
        } else { return redirect()->route('access_denied'); }
        }
    }

    public function searchDateAndBranch(Request $req){

        $section = 'searchDateAndBranch';   // dd($this->middleware_except);  
        if (auth()->user()->usr_type=='usr_admin') {
            if (in_array($section, $this->middleware_except)) {

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
        } else { return redirect()->route('access_denied'); }
        }
    }

    public function searchCategoryAndBranchAndDate(Request $req){

        $section = 'searchCategoryAndBranchAndDate';   // dd($this->middleware_except);  
        if (auth()->user()->usr_type=='usr_admin') {
            if (in_array($section, $this->middleware_except)) {

        $no=1;
        $from=$req['fromDate'];
        $to=$req['toDate'];
        $branch=$req['branch'];
        $category=$req['category'];
        
        $result=DB::table('expenses')
        ->join('expenses_categories','expenses.cat_id','=','expenses_categories.id')
        ->whereBetween('date', [$from, $to],)
        ->where('expense_catname', [$category])
        ->where('branch', [$branch])
        ->orderBy('date', 'DESC')
        ->get();

        $sum=DB::table('expenses')
        ->join('expenses_categories','expenses.cat_id','=','expenses_categories.id')
        ->whereBetween('date', [$from, $to],)
        ->where('expense_catname', [$category])
        ->where('branch', [$branch])
        ->orderBy('date', 'DESC')
        ->sum('amount');

        return view ('Admin\expense_search_result',['searchCategoryDateBranch'
        =>$result,'no'=>$no,'sum'=>$sum]); 
        } else { return redirect()->route('access_denied'); }
        }
    }

    public function searchCategoryAndBranchAndName(Request $req){

        $section = 'searchCategoryAndBranchAndName';   // dd($this->middleware_except);  
        if (auth()->user()->usr_type=='usr_admin') {
            if (in_array($section, $this->middleware_except)) {

        $no=1;
        $initiator=$req['initiator'];
        $branch=$req['branch'];
        $category=$req['category'];
        
        $result=DB::table('expenses')
        ->join('expenses_categories','expenses.cat_id','=','expenses_categories.id')
        ->where('initiator', [$initiator])
        ->where('expense_catname', [$category])
        ->where('branch', [$branch])
        ->orderBy('date', 'DESC')
        ->get();

        $sum=DB::table('expenses')
        ->join('expenses_categories','expenses.cat_id','=','expenses_categories.id')
        ->where('initiator', [$initiator])
        ->where('expense_catname', [$category])
        ->where('branch', [$branch])
        ->orderBy('date', 'DESC')
        ->sum('amount');

        return view ('Admin\expense_search_result',['searchCategoryNameBranch'
        =>$result,'no'=>$no,'sum'=>$sum]); 
        } else { return redirect()->route('access_denied'); }
        }
    }

    public function searchDateAndName(Request $req){

        $section = 'searchDateAndName';   // dd($this->middleware_except);  
        if (auth()->user()->usr_type=='usr_admin') {
            if (in_array($section, $this->middleware_except)) {

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
        } else { return redirect()->route('access_denied'); }
        }
    }

    public function searchBranchAndName(Request $req){

        $section = 'searchBranchAndName';   // dd($this->middleware_except);  
        if (auth()->user()->usr_type=='usr_admin') {
            if (in_array($section, $this->middleware_except)) { 

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
        } else { return redirect()->route('access_denied'); }
        }
    }

    public function searchDateAndBranchAndName(Request $req){

        $section = 'searchDateAndBranchAndName';   // dd($this->middleware_except);  
        if (auth()->user()->usr_type=='usr_admin') {
            if (in_array($section, $this->middleware_except)) { 

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

        return view ('Admin\expense_search_result',['searchBranchDateName'=>$result,'no'=>$no,'sum'=>$sum]); 
        } else { return redirect()->route('access_denied'); }
        }
    }

    public function searchDateAndCategoryAndName(Request $req){

        $section = 'searchDateAndCategoryAndName';   // dd($this->middleware_except);  
        if (auth()->user()->usr_type=='usr_admin') {
            if (in_array($section, $this->middleware_except)) { 
    
            $from=$req['fromDate'];   $no=1;
            $to=$req['toDate'];
            $initiator=$req['initiator'];
            $category=$req['category'];
            
            $result=DB::table('expenses')
            ->join('expenses_categories','expenses.cat_id','=','expenses_categories.id')
            ->whereBetween('date', [$from, $to],)
            ->where('initiator', $initiator,)
            ->where('expense_catname', [$category])
            ->orderBy('date', 'DESC')
            ->get();

            $sum=DB::table('expenses')
            ->join('expenses_categories','expenses.cat_id','=','expenses_categories.id')
            ->whereBetween('date', [$from, $to],)
            ->where('initiator', $initiator,)
            ->where('expense_catname', [$category])
            ->orderBy('date', 'DESC')
            ->sum('amount');

        return view ('Admin\expense_search_result',['searchCategoryDateName'=>$result,'no'=>$no,'sum'=>$sum]); 

        } else { return redirect()->route('access_denied'); }
        }
    }

    public function searchWithAll(Request $req){

        $section = 'searchWithAll';   // dd($this->middleware_except);  
        if (auth()->user()->usr_type=='usr_admin') {
            if (in_array($section, $this->middleware_except)) { 

        $no=1;
        $from=$req['fromDate'];
        $to=$req['toDate'];
        $initiator=$req['initiator'];
        $category=$req['category'];
        $branch=$req['branch'];
        
        $result=DB::table('expenses')
        ->join('expenses_categories','expenses.cat_id','=','expenses_categories.id')
        ->whereBetween('date', [$from, $to],)
        ->where('initiator', $initiator,)
        ->where('expense_catname', [$category])
        ->where('branch', [$branch])
        ->orderBy('date', 'DESC')
        ->get();

        $sum=DB::table('expenses')
        ->join('expenses_categories','expenses.cat_id','=','expenses_categories.id')
        ->whereBetween('date', [$from, $to],)
        ->where('initiator', $initiator,)
        ->where('expense_catname', [$category])
        ->where('branch', [$branch])
        ->orderBy('date', 'DESC')
        ->sum('amount');

        return view ('Admin\expense_search_result',['searchWithAll'=>$result,'no'=>$no,'sum'=>$sum]); 
        } else { return redirect()->route('access_denied'); }
        }
    }
    
}
