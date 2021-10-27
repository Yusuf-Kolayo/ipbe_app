<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Facades\Auth; 
use App\Models\Active_state;    
use App\Models\User; 
use App\Models\Access_permission;


class BaseController extends Controller
{

    

    public $app_sections = array ( 
        // ['dashboard',   [['index','Dashboard'],'resolve_notification','all_notifications','my_profile','profile','chat_board','post_chat','fetch_chat']],
        ['staff',       [['index','view staffs'],['show','staff profiles'],['store','store new staff'],['update','edit staff'],['destroy','delete staff'],['update_user_permission','assign permissions'],['refresh_permissions_ajax_fetch', 'refresh permissions after update']]],
        ['product',     [['index','view products'],['store','create new product'],['sub','product catalog'],['update_product_ajax_fetch','edit product form'],['show_details_ajax_fetch','product details modal'],['refresh_product_ajax_fetch','refresh edited product'],['show','product profile'],['trash','delete warning'],['edit','product edit page'],['update','product update'],['destroy','delete product']]],
        ['agent',       [['index','view agents'],['ajax_fetch','fetch agents'],['store','store new agents'],['show','agent profiles'],['update','edit agent'],['destroy','delete agent']]],
        ['client',      [['index','view clients'],['select_client','select client for product'],['store','create new client'],['show','client profiles'],['show_profile_ajax_fetch','client profile modal'],['update','edit client'],['destroy','delete client']]],
        ['transaction', [['index','view transactions'],['edit_trans_ajax_fetch','edit transaction form'],['delete_trans_ajax_fetch','delete transaction form'],['pps_details_ajax_fetch','purchase session modal'],['pps_delete_ajax_fetch','delete purchase session'],['trans_details_ajax_fetch','transaction details'],['new_purchase_session','start purchase session'],['approve_session','approve session'],['pause_session','pause session'],['delete_product_session','delete product session'],['create_deposit','create new deposits'],['update','update transaction'],['destroy','delete transaction']]],
        ['expense',     [['allExpensesCategories','expenses category'],['newExpensesCategory','create new category'],['editExpensesCatergory','edit expenses'],['deleteExpensesCatergory','delete expenses'],['addNewExpenses','new expenses form'],['saveExpenses','save new expenses'],['expensesPrint','print expenses'],['allExpenses','show all expenses'],['deleteExpenses','delete expenses'],['searchName','search by initiator '],['searchBranch','search by branch'],['searchDate','search by date'],['searchCategory','search by category'],['searchCategoryAndName','search by category'],['searchCategoryAndDate','search by date & category'],['searchCategoryAndBranch','search by category & branch'],['searchDateAndBranch','search by date & branch'],['searchCategoryAndBranchAndDate','search by category, branch & date'],['searchCategoryAndBranchAndName','search by category, branch & name'],['searchDateAndName','search by date & time'],['searchBranchAndName','serach by branch & name'],['searchDateAndBranchAndName','search by date, branch and name'],['searchDateAndCategoryAndName','search by date, category & name'],['searchWithAll','search ']]],
        ['category',    [['index','view product categories'],['sub_cat_ajax_fetch','fetch sub-category'],['store','save new category'],['trash','delete category'],['update','edit category'],['destroy','delete category']]],
        ['brand',       [['index','view brands'],['store','save new brand'],['update_brand_fetch', 'show brand update form'],['update','edit brand'],['delete_brand_fetch','show brand delete form'],['destroy','delete brand']]]
    );
    
    


    public function __construct()
    {   
        $this->middleware('auth');   
        $this->middleware(function ($request, $next) {    
            $user_id= Auth::user()->user_id;   $usr_type = Auth::user()->usr_type;


                $active_state = Active_state::where('user_id', $user_id)->first();
                if ($active_state) {
                    DB::table('active_states')->where('user_id', $user_id)
                    ->update([
                        'timestamp' => time()
                    ]); 
                } else {
                    $active_state = Active_state::create ([
                        'user_id' => $user_id,
                        'timestamp' => time()
                    ]);
                }

                return $next($request);
          
        });

    }


 


    public function get_time($sec, $patner_username) {
        $now = time();  
        $secdiff = $now-$sec;
        if ($secdiff==0)  { $time= '<i class="icon ni ni-user-round fg_skyblue"><\/i > '.$patner_username.'  &nbsp; &nbsp; <small class="active_msg">online<\/small >';  }
        
        elseif (($secdiff>0)&&($secdiff<=59))  { 
            if ($secdiff==1)  {  $time= '<i class="icon ni ni-user-round fg_skyblue"><\/i > '.$patner_username.'  &nbsp; &nbsp; <small class="active_msg">online - '.$secdiff.' sec<\/small >'; }
        elseif ($secdiff>1)  {  $time= '<i class="icon ni ni-user-round fg_skyblue"><\/i > '.$patner_username.'  &nbsp; &nbsp; <small class="active_msg">online - '.$secdiff.' sec<\/small >'; }  
        }
        
        elseif (($secdiff>=60)&&($secdiff<=3599))  { $tm = (int) ($secdiff/60);   
            
            if ($tm==1)  {   $time= '<i class="icon ni ni-user-round fg_skyblue"><\/i > '.$patner_username.'  &nbsp; &nbsp; <small class="active_msg">active - '.$tm.' min<\/small >';}
            elseif ($tm>1)  {  $time= '<i class="icon ni ni-user-round fg_grey"><\/i > '.$patner_username.'  &nbsp; &nbsp; <small class="active_msg">active - '.$tm.' mins<\/small >';} 
            }
        
        elseif (($secdiff>=3600)&&($secdiff<=86399))  { $tm = (int) ($secdiff/3600);  
            
            if ($tm==1)  {  $time= '<i class="icon ni ni-user-round fg_grey"><\/i > '.$patner_username.'  &nbsp; &nbsp; <small class="active_msg">offline - '.$tm.' hr<\/small >'; }
            elseif ($tm>1)  {  $time= '<i class="icon ni ni-user-round fg_grey"><\/i > '.$patner_username.'  &nbsp; &nbsp; <small class="active_msg">offline - '.$tm.' hrs<\/small >'; } 
        }
        
        elseif (($secdiff>=86400)&&($secdiff<=604800))  { $tm = (int) ($secdiff/86400);  
            
        if ($tm==1)  {  $time= '<i class="icon ni ni-user-round fg_grey"><\/i > '.$patner_username.'  &nbsp; &nbsp; <small class="active_msg">offline - '.$tm.' day<\/small >'; }
        elseif ($tm>1)  {   $time= '<i class="icon ni ni-user-round fg_grey"><\/i > '.$patner_username.'  &nbsp; &nbsp; <small class="active_msg">offline - '.$tm.' days<\/small >'; } 
        }
        elseif ($secdiff>=604801)  {  $time= '<i class="icon ni ni-user-round fg_grey"><\/i > '.$patner_username.'  &nbsp; &nbsp; <small class="active_msg">offline - '.date('d-M-Y',$sec).'<\/small >';  }
        
        return $time;
    } 


}





