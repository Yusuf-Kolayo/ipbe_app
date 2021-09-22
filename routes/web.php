<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CatchmentController;
use App\Http\Controllers\Admin\AgentController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\ExpenseController;
use App\Http\Controllers\Agent\ClientController;
use App\Http\Controllers\Agent\TransactionController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {  return view('welcome'); });

Route::get('/', function () { return redirect()->route('login'); });
Route::get('/agent/referrer/{agent_id}', [AgentController::class, 'show_referring_form'])->name('agent.show_referring_form');
Route::post('/agent/send_referee_mail/', [AgentController::class, 'send_referee_mail'])->name('agent.send_referee_mail');
Route::get('/agent/check_referee_code/', [AgentController::class, 'check_referee_code'])->name('agent.check_referee_code');

//=========================      PUBLIC ROUTES      ==========================//
Auth::routes();
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/chat_board', [DashboardController::class, 'chat_board'])->name('chat_board');
Route::get('/resolve_notification/{id}', [DashboardController::class, 'resolve_notification'])->name('resolve_notification');
Route::get('/all_notifications/', [DashboardController::class, 'all_notifications'])->name('all_notifications');
Route::get('/my_profile/', [DashboardController::class, 'my_profile'])->name('my_profile');
Route::get('/access_denied', function () { return view('access_denied'); })->name('access_denied');
   
    
    
//=========================      ADMIN ROUTES      ==========================//
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'is_admin']], function() {     
    Route::get('/catchment/ajax_fetch_lga', [CatchmentController::class, 'ajax_fetch_lga'])->name('catchment.ajax_fetch_lga');
    Route::get('/catchment/{catchment}/trash', [CatchmentController::class, 'trash'])->name('catchment.trash');
    Route::resource('catchment', CatchmentController::class);
    
    Route::post('/transaction/delete_product_session', [TransactionController::class, 'delete_product_session'])->name('client.delete_product_session');
    Route::post('/transaction/pause_session', [TransactionController::class, 'pause_session'])->name('client.pause_session');
    Route::post('/transaction/approve_session', [TransactionController::class, 'approve_session'])->name('client.approve_session');
    
    Route::get('/product/refresh_product_ajax_fetch', [ProductController::class, 'refresh_product_ajax_fetch'])->name('product.refresh_product_ajax_fetch');
    Route::get('/product/update_product_ajax_fetch', [ProductController::class, 'update_product_ajax_fetch'])->name('product.update_ajax_fetch');
   
   
    
    Route::resource('brand', BrandController::class);
    
   
});


//=========================      AGENT ROUTES      ==========================//
Route::group (['prefix' => 'agent', 'middleware' => ['auth', 'is_agent']], function() {
    Route::get('/agent/catalog', [ClientController::class, 'delete'])->name('agent.catalog'); 
    Route::get('/product/select_client/', [ClientController::class, 'select_client'])->name('client.select_client');
    
    Route::post('/client/new_purchase_session/', [TransactionController::class, 'new_purchase_session'])->name('client.new_purchase_session');
});



//=========================      ADMIN/AGENT ROUTES      ==========================//
Route::group (['prefix' => 'admin_agent', 'middleware' => ['auth', 'is_admin_agent']], function() {
    Route::get('/agent/ajax_fetch', [AgentController::class, 'ajax_fetch'])->name('agent.ajax_fetch');
    Route::resource('agent', AgentController::class);

    Route::get('/product/show_details_ajax_fetch', [ProductController::class, 'show_details_ajax_fetch'])->name('product.show_details_ajax_fetch');
    Route::get('/product/sub/{sub_category_id}', [ProductController::class, 'sub'])->name('product.sub');
    Route::resource('product', ProductController::class);
    
    Route::get('/client/show_profile_ajax_fetch', [ClientController::class, 'show_profile_ajax_fetch'])->name('client.show_profile_ajax_fetch');
    Route::get('/client/{client}/delete', [ClientController::class, 'delete'])->name('client.delete');  
    
    // Route::get('/client/show/{client}/{flash_msg?}', [ClientController::class, 'show'])->name('client.show');  
    
    Route::get('/transaction/delete_trans_ajax_fetch', [TransactionController::class, 'delete_trans_ajax_fetch'])->name('transaction.delete_trans_ajax_fetch');
    Route::get('/transaction/edit_trans_ajax_fetch', [TransactionController::class, 'edit_trans_ajax_fetch'])->name('transaction.edit_trans_ajax_fetch');
    Route::post('/transaction/create_deposit', [TransactionController::class, 'create_deposit'])->name('client.create_deposit');

    Route::get('/transaction/trans_details_ajax_fetch', [TransactionController::class, 'trans_details_ajax_fetch'])->name('client.trans_details_ajax_fetch');
    Route::get('/transaction/pps_delete_ajax_fetch', [TransactionController::class, 'pps_delete_ajax_fetch'])->name('client.pps_delete_ajax_fetch');
    Route::get('/transaction/pps_details_ajax_fetch', [TransactionController::class, 'pps_details_ajax_fetch'])->name('client.pps_details_ajax_fetch');
  
    Route::resource('transaction', TransactionController::class); 
    Route::resource('client', ClientController::class);  
    
    Route::get('/category/sub_cat_ajax_fetch', [CategoryController::class, 'sub_cat_ajax_fetch'])->name('category.sub_cat_ajax_fetch');
    Route::resource('category', CategoryController::class);
});

Route::get('/company/expenses/all',[ExpenseController::class,'allExpenses'])->name('expenses_list');
//Route::get('/company_expenses','App\Http\Controllers\Admin\ExpenseController@allExpensesCatergories')->name('admin_expenses');
Route::get('/company/expenses/add_or_delete_catergory',[ExpenseController::class,'allExpensesCatergories'])->name('expenses_cat');
Route::post('/company/expenses/add_or_delete_catergory',[ExpenseController::class,'newExpensesCatgory'])->name('cat_newname');
Route::post('/company/expenses/delete_catergory{id}',[ExpenseController::class,'deleteExpensesCatergory'])->name('delete_catname');
Route::post('/company/expenses/edit_catergory{id}',[ExpenseController::class,'editExpensesCatergory'])->name('edit_catname');

Route::post('/company/expenses/save_new_expense',[ExpenseController::class,'saveExpenses'])->name('save_new_expense');
Route::get('/company/expenses/add_newexpenses',[ExpenseController::class,'addNewExpenses'])->name('new_expense');
Route::post('/company/expenses/delete_expense{id}',[ExpenseController::class,'deleteExpenses'])->name('delete_expense');
Route::get('/company/expenses/print',[ExpenseController::class,'expensesPrint'])->name('expenses_print');

Route::get('/company/expenses/search_with_date',[ExpenseController::class,'searchDate'])->name('date_search');
Route::get('/company/expenses/search_with_name',[ExpenseController::class,'searchName'])->name('name_search');
Route::get('/company/expenses/search_with_branch',[ExpenseController::class,'searchBranch'])->name('name_branch');
Route::get('/company/expenses/search_with_date_and_branch',[ExpenseController::class,'searchDateAndBranch'])->name('branch_date');
Route::get('/company/expenses/search_with_date_and_name',[ExpenseController::class,'searchDateAndName'])->name('date_name');
Route::get('/company/expenses/search_with_branch_and_name',[ExpenseController::class,'searchBranchAndName'])->name('branch_name');
Route::get('/company/expenses/search_with_all',[ExpenseController::class,'searchWithAll'])->name('search_all');
Route::get('/company/expenses/search_result', function () {
    return view('expense_search_result');
});

