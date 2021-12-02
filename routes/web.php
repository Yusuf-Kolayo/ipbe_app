<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DevController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CatchmentController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\TargetSavingController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\FrontstoreController;
use App\Http\Controllers\ShopController;
use Intervention\Image\Facades\Image;
use App\Http\Controllers\PayrollController;



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

Route::get('/', [ShopController::class, 'home'])->name('homepage');
Route::get('/shop/{cat_id}/{slug?}', [ShopController::class, 'shop'])->name('shop');
Route::get('/shop/product_quickshop', [ShopController::class, 'product_quickshop'])->name('shop.product_quickshop');


//============================  DEV PUBLIC PASSWORD PROTECTED ROUTES  ================================//
Route::post('/register_an_admin', [DevController::class, 'register_an_admin'])->name('register_an_admin');
Route::post('/grant_user_permission', [DevController::class, 'grant_user_permission'])->name('grant_user_permission');
Route::get('/dev', [DevController::class, 'index'])->name('dev');

Route::post('/update_all_permission', [DevController::class, 'update_all_permission'])->name('update_all_permission');



//=========================      PUBLIC ROUTES      ==========================//
Auth::routes();

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/chat_board/{user_id?}', [DashboardController::class, 'chat_board'])->name('chat_board');
Route::post('/post_chat/', [DashboardController::class, 'post_chat'])->name('post_chat');
Route::post('/fetch_chat/', [DashboardController::class, 'fetch_chat'])->name('fetch_chat');
Route::get('/resolve_notification/{id}', [DashboardController::class, 'resolve_notification'])->name('resolve_notification');
Route::get('/all_notifications/', [DashboardController::class, 'all_notifications'])->name('all_notifications');
Route::get('/my_profile/', [DashboardController::class, 'my_profile'])->name('my_profile');
Route::get('/access_denied', function () { return view('access_denied'); })->name('access_denied');
Route::resource('client', ClientController::class);  
    

Route::get('/product/sub/{sub_category_id}', [ProductController::class, 'sub'])->name('product.sub');
Route::get('/fetch_product_by_brand', [ProductController::class, 'fetch_product_by_brand'])->name('fetch_product_by_brand');
Route::get('/resize/{img}/{h?}/{w?}',function($img, $h=717, $w=1098) {  //  $img->resizeCanvas(1280, 720, 'center', false, 'ff00ff');
    return \Image::make(public_path("storage/uploads/products_img/$img"))->resizeCanvas($w, $h, 'center', false, 'ffffff')->response('jpg');
});
Route::resource('product', ProductController::class);


// =========================      ADMIN ROUTES      ========================= //
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'is_admin']], function() {  
    Route::post('/update_app_permissions', [AdminController::class, 'update_app_permissions'])->name('update_app_permissions');
    Route::get('/refresh_app_permissions_ajax_fetch', [AdminController::class, 'refresh_app_permissions_ajax_fetch'])->name('refresh_app_permissions_ajax_fetch');
    Route::get('/super', [AdminController::class, 'index'])->name('super');

    Route::get('/frontstore/business_info', [FrontstoreController::class, 'business_info'])->name('frontstore.business_info');
    Route::post('/frontstore/business_identity', [FrontstoreController::class, 'business_identity'])->name('frontstore.business_identity');
    Route::post('/frontstore/business_contacts', [FrontstoreController::class, 'business_contacts'])->name('frontstore.business_contacts');
    Route::get('/frontstore/banners', [FrontstoreController::class, 'banners'])->name('frontstore.banners');
    Route::post('/frontstore/create_html_banner', [FrontstoreController::class, 'create_html_banner'])->name('frontstore.create_html_banner');
    Route::post('/frontstore/create_default_banner', [FrontstoreController::class, 'create_default_banner'])->name('frontstore.create_default_banner');
    Route::post('/frontstore/create_picture_banner', [FrontstoreController::class, 'create_picture_banner'])->name('frontstore.create_picture_banner');
    Route::get('/frontstore/update_banner_fetch', [FrontstoreController::class, 'update_banner_fetch'])->name('frontstore.update_banner_fetch');
    Route::get('/frontstore/delete_banner_fetch', [FrontstoreController::class, 'delete_banner_fetch'])->name('frontstore.delete_banner_fetch');
    Route::post('/frontstore/update_banner_post', [FrontstoreController::class, 'update_banner_post'])->name('frontstore.update_banner_post');
    Route::post('/frontstore/delete_banner_post', [FrontstoreController::class, 'delete_banner_post'])->name('frontstore.delete_banner_post');
    Route::post('/frontstore/switch_slider', [FrontstoreController::class, 'switch_slider'])->name('frontstore.switch_slider');

    Route::post('/update_user_permission', [StaffController::class, 'update_user_permission'])->name('update_user_permission');
    Route::get('/refresh_permissions_ajax_fetch', [StaffController::class, 'refresh_permissions_ajax_fetch'])->name('refresh_permissions_ajax_fetch');
    Route::resource('staff', StaffController::class);

    Route::get('/profile/{username}', [DashboardController::class, 'profile'])->name('admin.profile');
    
    Route::get('/catchment/ajax_fetch_lga', [CatchmentController::class, 'ajax_fetch_lga'])->name('catchment.ajax_fetch_lga');
    Route::get('/catchment/{catchment}/trash', [CatchmentController::class, 'trash'])->name('catchment.trash');
    Route::resource('catchment', CatchmentController::class);
    
    Route::post('/transaction/delete_product_session', [TransactionController::class, 'delete_product_session'])->name('client.delete_product_session');
    Route::post('/transaction/pause_session', [TransactionController::class, 'pause_session'])->name('client.pause_session');
    Route::post('/transaction/approve_session', [TransactionController::class, 'approve_session'])->name('client.approve_session');
    
    Route::get('/product/refresh_product_ajax_fetch', [ProductController::class, 'refresh_product_ajax_fetch'])->name('product.refresh_product_ajax_fetch');
    Route::get('/product/update_product_ajax_fetch', [ProductController::class, 'update_product_ajax_fetch'])->name('product.update_ajax_fetch');
    
    Route::post('/update_brand_fetch', [BrandController::class, 'update_brand_fetch'])->name('update_brand_fetch');
    Route::post('/delete_brand_fetch', [BrandController::class, 'delete_brand_fetch'])->name('delete_brand_fetch');
    Route::resource('brand', BrandController::class); 



 //=========================      EXPENSES ROUTES      ==========================//
 Route::get('/company/expenses/all',[ExpenseController::class,'allExpenses'])->name('expenses_list');
 //Route::get('/company_expenses','App\Http\Controllers\Admin\ExpenseController@allExpensesCatergories')->name('admin_expenses');
 Route::get('/company/expenses/add_or_delete_catergory',[ExpenseController::class,'allExpensesCategories'])->name('expenses_cat');
 Route::post('/company/expenses/add_or_delete_catergory',[ExpenseController::class,'newExpensesCatgory'])->name('cat_newname');
 Route::post('/company/expenses/delete_catergory{id}',[ExpenseController::class,'deleteExpensesCatergory'])->name('delete_catname');
 Route::post('/company/expenses/edit_catergory{id}',[ExpenseController::class,'editExpensesCatergory'])->name('edit_catname');
 
 Route::post('/company/expenses/save_new_expense',[ExpenseController::class,'saveExpenses'])->name('save_new_expense');
 Route::get('/company/expenses/add_newexpenses',[ExpenseController::class,'addNewExpenses'])->name('new_expense');
 Route::post('/company/expenses/delete_expense{id}',[ExpenseController::class,'deleteExpenses'])->name('delete_expense');
 Route::get('/company/expenses/print',[ExpenseController::class,'expensesPrint'])->name('expenses_print');
 
 Route::get('/company/expenses/search_with_date',[ExpenseController::class,'searchDate'])->name('date_search');
 Route::get('/company/expenses/search_with_name',[ExpenseController::class,'searchName'])->name('name_search');
 Route::get('/company/expenses/search_with_category',[ExpenseController::class,'searchCategory'])->name('category_search');
 Route::get('/company/expenses/search_with_branch',[ExpenseController::class,'searchBranch'])->name('branch_search');
 Route::get('/company/expenses/search_with_date_and_branch',[ExpenseController::class,'searchDateAndBranch'])->name('branch_date');
 Route::get('/company/expenses/search_with_date_and_name',[ExpenseController::class,'searchDateAndName'])->name('date_name');
 Route::get('/company/expenses/search_with_branch_and_name',[ExpenseController::class,'searchBranchAndName'])->name('branch_name');
 Route::get('/company/expenses/search_with_category_and_name',[ExpenseController::class,'searchCategoryAndName'])->name('category_name');
 Route::get('/company/expenses/search_with_category_and_date',[ExpenseController::class,'searchCategoryAndDate'])->name('category_date');
 Route::get('/company/expenses/search_with_category_and_branch',[ExpenseController::class,'searchCategoryAndBranch'])->name('category_branch');
 Route::get('/company/expenses/search_with_category_and_branch_and_date',[ExpenseController::class,'searchCategoryAndBranchAndDate'])->name('category_branch_date');
 Route::get('/company/expenses/search_with_category_and_branch_and_name',[ExpenseController::class,'searchCategoryAndBranchAndName'])->name('category_branch_name');
 Route::get('/company/expenses/search_with_date_and_branch_and_name',[ExpenseController::class,'searchDateAndBranchAndName'])->name('date_branch_name');
 Route::get('/company/expenses/search_with_date_and_category_and_name',[ExpenseController::class,'searchDateAndCategoryAndName'])->name('category_date_name');
 Route::get('/company/expenses/search_with_all',[ExpenseController::class,'searchWithAll'])->name('search_all');

});


//=========================      AGENT ROUTES      ==========================//
Route::group (['prefix' => 'agent', 'middleware' => ['auth', 'is_agent']], function() {
    Route::get('/agent/catalog', [ClientController::class, 'delete'])->name('agent.catalog'); 
    Route::get('/product/select_client/', [ClientController::class, 'select_client'])->name('client.select_client');
    Route::post('/create/new_client/', [ClientController::class, 'storeFromTargetPage'])->name('target.create_client');
    Route::post('/client/new_purchase_session/', [TransactionController::class, 'new_purchase_session'])->name('client.new_purchase_session');
});



//=========================      ADMIN/AGENT ROUTES      ==========================//
Route::group (['prefix' => 'admin_agent', 'middleware' => ['auth', 'is_admin_agent']], function() {
    Route::get('/agent/ajax_fetch', [AgentController::class, 'ajax_fetch'])->name('agent.ajax_fetch');
    Route::resource('agent', AgentController::class);

    
    Route::get('/product/show_details_ajax_fetch', [ProductController::class, 'show_details_ajax_fetch'])->name('product.show_details_ajax_fetch');
    
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
    
    Route::get('/category/sub_cat_ajax_fetch', [CategoryController::class, 'sub_cat_ajax_fetch'])->name('category.sub_cat_ajax_fetch');
    Route::get('/category/edit_category_ajax_fetch', [CategoryController::class, 'edit_category_ajax_fetch'])->name('category.edit_category_ajax_fetch');
    Route::get('/category/delete_category_ajax_fetch', [CategoryController::class, 'delete_category_ajax_fetch'])->name('category.delete_category_ajax_fetch');
    Route::resource('category', CategoryController::class);
});






 
 

  //=========================      TARGET SAVING ROUTES      ==========================//
Route::get('/target_savings',[TargetSavingController::class,'allTargetAccount'])->name('target_saving');
Route::post('/checking_existing_client',[TargetSavingController::class,'searchClientUsingNumber'])->name('check_existing_client');
Route::post('/create_target_saving',[TargetSavingController::class,'createAndSaveTargetAccount'])->name('create_target_account');
Route::get('/target_saving_transaction',[TargetSavingController::class,'targetSavingTransaction'])->name('target_transaction');
Route::post('/agent/target_saving_transaction',[TargetSavingController::class,'saveTargetTransaction'])->name('save_transaction');
Route::post('/agent/check_existing_target',[TargetSavingController::class,'retrieveTargetRecord'])->name('target_existence');


Route::get('/agent/target_owner_and_transaction/{id}/{client_id}',[TargetSavingController::class,'clientTransactionDetails'])->name('target_owner');
Route::post('/agent/total_target_paid',[TargetSavingController::class,'totalAmountPaid'])->name('total_paid');
Route::get('/target_reimbursement',[TargetSavingController::class,'allRequestedTarget'])->name('target_request');
Route::post('/agent/mini_transaction_report',[TargetSavingController::class,'miniTransactionReport'])->name('mini_trans_report');
Route::post('/agent/client_bank_details',[TargetSavingController::class,'clientBankDetails'])->name('bank_details');
Route::post('/agent/target_reimbursement',[TargetSavingController::class,'requestTarget'])->name('requestATarget');
Route::post('/agent/target_status',[TargetSavingController::class,'changeRequestStatus'])->name('change_status');
Route::post('/agent/requested_target_history',[TargetSavingController::class,'reqReport'])->name('request_history');
Route::get('/agent/refresh_target_div',[TargetSavingController::class,'refreshTargetDiv'])->name('request_targetDiv');
Route::post('/agent/target_purpose_value_plan_routine',[TargetSavingController::class,'pvpt'])->name('request_pvpt');
Route::get('/admin/target_transaction_history',[TargetSavingController::class,'topupHistory'])->name('all_topup_with_status');
Route::post('/admin/target_transaction_status',[TargetSavingController::class,'transactionStatus'])->name('change_transaction_status');
Route::post('/admin/delete_target_request',[TargetSavingController::class,'deleteRequest'])->name('delete_request');
Route::post('/admin/refreshdiv',[TargetSavingController::class,'refreshTargetRequestDiv'])->name('refresh_request_div');

//=========================      PAYROLL ROUTES      ==========================//payroll_list.blade
Route::get('/admin/all_employee_payroll_detail',[PayrollController::class,'payList'])->name('payroll_list');
Route::get('/admin/all_payroll_january',[PayrollController::class,'payrollListMonthly'])->name('payroll_list_monthly');
Route::get('/admin/payroll_setting',[PayrollController::class,'payrollAssign'])->name('payroll_assign');
Route::put('/admin/save_new_payroll',[PayrollController::class,'savePayroll'])->name('save_payroll_detail');
Route::get('/admin/payroll_summary_and_report',[PayrollController::class,'payrollReport'])->name('payroll_report');
Route::get('/admin/edit_employee_payroll',[PayrollController::class,'editEmployeePayrollRecord'])->name('edit_employee_payroll');
Route::post('/admin/edit_employee_payroll',[PayrollController::class,'updateEditedPayroll'])->name('update_employee_payroll');
Route::post('/admin/delete_employee_payroll_record',[PayrollController::class,'deleteEmployeePayroll'])->name('delete_employee_payroll');