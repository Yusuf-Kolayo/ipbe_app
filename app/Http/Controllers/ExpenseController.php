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


    public $title = 'expense';


    public function __construct() {
       $this->middleware('auth');
       parent::__construct(); 
    }

     
    public function allExpensesCatergories() {

        if (!in_array($this->title, parent::app_sections_only())) {    
            return redirect()->route('access_denied'); 
        }

        if (auth()->user()->usr_type=='usr_admin') {
            if (!in_array(__FUNCTION__, parent::middleware_except())) {
                return redirect()->route('access_denied'); 
            }  
        }   

        // this category function loads all expenses category created
        $data=Expenses_category::orderBy('expense_catname', 'ASC')->get();   $no=1;
        return view('Admin\expenseseditcat',['data'=>$data,'no'=>$no]);
    }
        
    public function newExpensesCatgory(Request $cat){

        if (!in_array($this->title, parent::app_sections_only())) {    
            return redirect()->route('access_denied'); 
        }

        if (auth()->user()->usr_type=='usr_admin') {
            if (!in_array(__FUNCTION__, parent::middleware_except())) {
                return redirect()->route('access_denied'); 
            }  
        }   


        //this category function saves any new category created
        $this->validate($cat,[
            'cat_name'=>'required|unique:expenses_categories,expense_catname',
        ]);
        // save to database
        $catname = new Expenses_category();
        
        //On left field name in DB and on right field name in Form/view
        $catname->expense_catname = $cat->cat_name;
        $catname->save();
        $name=$cat->cat_name;
    
        return redirect()->back()->with('status',$name.' Added Successfully');
    }

    public function editExpensesCatergory(Request $req) {

        if (!in_array($this->title, parent::app_sections_only())) {    
            return redirect()->route('access_denied'); 
        }

        if (auth()->user()->usr_type=='usr_admin') {
            if (!in_array(__FUNCTION__, parent::middleware_except())) {
                return redirect()->route('access_denied'); 
            }  
        }   


        //this category edits any category name already created
        $id = $req['id'];
        $catName=$req['catName'];
        $data=Expenses_category::find($id);
        $data->expense_catname=$catName;
        $data->save();
        echo('Category name changed successfully');   //return redirect()->back();   
    }
    
    //this category function deletes expenses category name
    public function deleteExpensesCatergory($id) {

        if (!in_array($this->title, parent::app_sections_only())) {    
            return redirect()->route('access_denied'); 
        }

        if (auth()->user()->usr_type=='usr_admin') {
            if (!in_array(__FUNCTION__, parent::middleware_except())) {
                return redirect()->route('access_denied'); 
            }  
        }   


        $data=Expenses_category::find($id);
        $data->delete();
        //return redirect()->back()->with('status','Deleted Successfully');
        echo('Deleted Successfully'); 
    }

     // EXPENSES  FUNCTION 
    public function addNewExpenses() {

        if (!in_array($this->title, parent::app_sections_only())) {    
            return redirect()->route('access_denied'); 
        }

        if (auth()->user()->usr_type=='usr_admin') {
            if (!in_array(__FUNCTION__, parent::middleware_except())) {
                return redirect()->route('access_denied'); 
            }  
        }   
        
        //this will return expenses category into the select option and view the add new expenses page
        $data= Expenses_category::orderBy('expense_catname', 'ASC')->get();
        return view ('Admin\expensesnew',['category'=>$data]);
    }
     

    public function saveExpenses(Request $exp) {

        if (!in_array($this->title, parent::app_sections_only())) {    
            return redirect()->route('access_denied'); 
        }

        if (auth()->user()->usr_type=='usr_admin') {
            if (!in_array(__FUNCTION__, parent::middleware_except())) {
                return redirect()->route('access_denied'); 
            }  
        }   


        
        //this will saves new expenses created to database
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

    public function expensesPrint() {
        if (!in_array($this->title, parent::app_sections_only())) {    
            return redirect()->route('access_denied'); 
        }

        if (auth()->user()->usr_type=='usr_admin') {
            if (!in_array(__FUNCTION__, parent::middleware_except())) {
                return redirect()->route('access_denied'); 
            }  
        }   


        $category=Expenses_category::orderBy('expense_catname', 'ASC')->get();
        return view ('Admin\expensesprint',['category'=>$category]);
    }


    public function allExpenses(){
        if (!in_array($this->title, parent::app_sections_only())) {    
            return redirect()->route('access_denied'); 
        }

        if (auth()->user()->usr_type=='usr_admin') {
            if (!in_array(__FUNCTION__, parent::middleware_except())) {
                return redirect()->route('access_denied'); 
            }  
        }   


        
        //this will return all list of expenses
        $allExpense=Expense::join('expenses_categories','expenses.cat_id','=','expenses_categories.id')
        ->orderBy('date', 'DESC')
        ->get();

        $category=Expenses_category::orderBy('expense_catname', 'ASC')->get();

        $no=1;
        return view ('Admin\expenses',['Expense'=>$allExpense,'no'=>$no,'category'=>$category]) ; 
              
    }

    public function deleteExpenses(Request $req){

        if (!in_array($this->title, parent::app_sections_only())) {    
            return redirect()->route('access_denied'); 
        }

        if (auth()->user()->usr_type=='usr_admin') {
            if (!in_array(__FUNCTION__, parent::middleware_except())) {
                return redirect()->route('access_denied'); 
            }  
        }   

 
        //this will delete a particular expenses
        $expense_id=$req['expense_id'];
        DB::table('expenses')->where('expense_id', $expense_id)->delete();
        //echo "successful";
        return redirect()->back();
    }

    public function searchName(Request $req) {

        if (!in_array($this->title, parent::app_sections_only())) {    
            return redirect()->route('access_denied'); 
        }

        if (auth()->user()->usr_type=='usr_admin') {
            if (!in_array(__FUNCTION__, parent::middleware_except())) {
                return redirect()->route('access_denied'); 
            }  
        }   

        
        //this function will search for expenses using name
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

    public function searchBranch(Request $req) {

        if (!in_array($this->title, parent::app_sections_only())) {    
            return redirect()->route('access_denied'); 
        }

        if (auth()->user()->usr_type=='usr_admin') {
            if (!in_array(__FUNCTION__, parent::middleware_except())) {
                return redirect()->route('access_denied'); 
            }  
        }   

        $section = 'searchBranch';   // dd(parent::middleware_except());  
        if (auth()->user()->usr_type=='usr_admin') {
            if (in_array(__FUNCTION__, parent::middleware_except())) {

        //this function will search for expenses using branch
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

        if (!in_array($this->title, parent::app_sections_only())) {    
            return redirect()->route('access_denied'); 
        }

        if (auth()->user()->usr_type=='usr_admin') {
            if (!in_array(__FUNCTION__, parent::middleware_except())) {
                return redirect()->route('access_denied'); 
            }  
        }   


        
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

    public function searchCategory(request $req) {    
    
        if (!in_array($this->title, parent::app_sections_only())) {    
            return redirect()->route('access_denied'); 
        }

        if (auth()->user()->usr_type=='usr_admin') {
            if (!in_array(__FUNCTION__, parent::middleware_except())) {
                return redirect()->route('access_denied'); 
            }  
        }   


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
    }

    public function searchCategoryAndName(request $req){

        if (!in_array($this->title, parent::app_sections_only())) {    
            return redirect()->route('access_denied'); 
        }

        if (auth()->user()->usr_type=='usr_admin') {
            if (!in_array(__FUNCTION__, parent::middleware_except())) {
                return redirect()->route('access_denied'); 
            }  
        }   


        
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
       
    }

    public function searchCategoryAndDate(request $req){

        if (!in_array($this->title, parent::app_sections_only())) {    
            return redirect()->route('access_denied'); 
        }

        if (auth()->user()->usr_type=='usr_admin') {
            if (!in_array(__FUNCTION__, parent::middleware_except())) {
                return redirect()->route('access_denied'); 
            }  
        }   

 
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

    }

    public function searchCategoryAndBranch(request $req){

        if (!in_array($this->title, parent::app_sections_only())) {    
            return redirect()->route('access_denied'); 
        }

        if (auth()->user()->usr_type=='usr_admin') {
            if (!in_array(__FUNCTION__, parent::middleware_except())) {
                return redirect()->route('access_denied'); 
            }  
        }   


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
    }

    public function searchDateAndBranch(Request $req){

        if (!in_array($this->title, parent::app_sections_only())) {    
            return redirect()->route('access_denied'); 
        }

        if (auth()->user()->usr_type=='usr_admin') {
            if (!in_array(__FUNCTION__, parent::middleware_except())) {
                return redirect()->route('access_denied'); 
            }  
        }   


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

    public function searchCategoryAndBranchAndDate(Request $req){

        if (!in_array($this->title, parent::app_sections_only())) {    
            return redirect()->route('access_denied'); 
        }

        if (auth()->user()->usr_type=='usr_admin') {
            if (!in_array(__FUNCTION__, parent::middleware_except())) {
                return redirect()->route('access_denied'); 
            }  
        }   

  
        
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
    }

    public function searchCategoryAndBranchAndName(Request $req){

        if (!in_array($this->title, parent::app_sections_only())) {    
            return redirect()->route('access_denied'); 
        }

        if (auth()->user()->usr_type=='usr_admin') {
            if (!in_array(__FUNCTION__, parent::middleware_except())) {
                return redirect()->route('access_denied'); 
            }  
        }   


        
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
    }

    public function searchDateAndName(Request $req){

        if (!in_array($this->title, parent::app_sections_only())) {    
            return redirect()->route('access_denied'); 
        }

        if (auth()->user()->usr_type=='usr_admin') {
            if (!in_array(__FUNCTION__, parent::middleware_except())) {
                return redirect()->route('access_denied'); 
            }  
        }   


        
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
        if (!in_array($this->title, parent::app_sections_only())) {    
            return redirect()->route('access_denied'); 
        }

        if (auth()->user()->usr_type=='usr_admin') {
            if (!in_array(__FUNCTION__, parent::middleware_except())) {
                return redirect()->route('access_denied'); 
            }  
        }   


    
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

    public function searchDateAndBranchAndName(Request $req){
        if (!in_array($this->title, parent::app_sections_only())) {    
            return redirect()->route('access_denied'); 
        }

        if (auth()->user()->usr_type=='usr_admin') {
            if (!in_array(__FUNCTION__, parent::middleware_except())) {
                return redirect()->route('access_denied'); 
            }  
        }   
        


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
      
    }

    public function searchDateAndCategoryAndName(Request $req){
        if (!in_array($this->title, parent::app_sections_only())) {    
            return redirect()->route('access_denied'); 
        }

        if (auth()->user()->usr_type=='usr_admin') {
            if (!in_array(__FUNCTION__, parent::middleware_except())) {
                return redirect()->route('access_denied'); 
            }  
        }   

   
        
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

    }

    public function searchWithAll(Request $req){
        if (!in_array($this->title, parent::app_sections_only())) {    
            return redirect()->route('access_denied'); 
        }

        if (auth()->user()->usr_type=='usr_admin') {
            if (!in_array(__FUNCTION__, parent::middleware_except())) {
                return redirect()->route('access_denied'); 
            }  
        }   


        
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
      
    }
    
}
