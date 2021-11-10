<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 
use App\Models\Client;
use App\Models\User;
use App\Models\Target_saving;
use App\Models\Target_transaction;
use App\Models\Target_request;
use App\Models\Notification; 




class TargetSavingController extends BaseController
{
    
    
    public $title = 'target_savings';


    //returns all target-saving account that has been created
    public function allTargetAccount(){
        if (!in_array($this->title, parent::app_sections_only())) {    
            return redirect()->route('access_denied'); 
        } 

        if (auth()->user()->usr_type=='usr_admin') {
            if (!in_array(__FUNCTION__, parent::middleware_except())) {
                return redirect()->route('access_denied'); 
            }  
        }

        if(auth()->user()->usr_type=='usr_agent'){
            $agent_id=auth()->user()->user_id;
            $allTargets=Target_saving::where('agent_id',$agent_id)->orderBy('created_at', 'DESC')->get();
        }else if(auth()->user()->usr_type=='usr_client'){
            $client_id=auth()->user()->user_id;
            $allTargets=Target_saving::where('client_id',$client_id)->orderBy('created_at', 'DESC')->get();
        }else{
            $allTargets=Target_saving::orderBy('created_at', 'DESC')->get();
        }
        return view ('Agent\target_saving',['data'=>$allTargets]);
    }

    //the function refresh the all target div immdiately after a target is created 
    public function refreshTargetDiv(){
        if (!in_array($this->title, parent::app_sections_only())) {    
            return redirect()->route('access_denied'); 
        } 

        if (auth()->user()->usr_type=='usr_admin') {
            if (!in_array(__FUNCTION__, parent::middleware_except())) {
                return redirect()->route('access_denied'); 
            }  
        }
        
        if(auth()->user()->usr_type=='usr_agent'){
            $agent_id=auth()->user()->user_id;
            $allTargets=Target_saving::where('agent_id',$agent_id)->orderBy('created_at', 'DESC')->get();
        }else if(auth()->user()->usr_type=='usr_client'){
            $client_id=auth()->user()->user_id;
            $allTargets=Target_saving::where('client_id',$client_id)->orderBy('created_at', 'DESC')->get();
        }else{
            $allTargets=Target_saving::orderBy('created_at', 'DESC')->get();
        }
        return view ('Agent\target_saving',['data'=>$allTargets]);
    }

    //this search for client with number to see if thier record is our database
    public function searchClientUsingNumber(Request $req){  
        if (!in_array($this->title, parent::app_sections_only())) {    
            return redirect()->route('access_denied'); 
        }

        if (auth()->user()->usr_type=='usr_admin') {
            if (!in_array(__FUNCTION__, parent::middleware_except())) {
                return redirect()->route('access_denied'); 
            }  
        }   

        $phoneNo=$req['phone'];
        $client = Client::where('phone',$phoneNo)->first();

        $norecord='no record';

        if($client==null){
            return view ('agent\ajax_target_form',['existingClient'=>$norecord]);
        }else{
            return view ('agent\ajax_target_form',['existingClient'=>$client]);
        }
        
        
    }

    //this will save created target to database
    public function createAndSaveTargetAccount(Request $req){
        if (!in_array($this->title, parent::app_sections_only())) {    
            return redirect()->route('access_denied'); 
        }
        $agent_id=Auth()->User()->user_id;

        if (auth()->user()->usr_type=='usr_admin') {
            if (!in_array(__FUNCTION__, parent::middleware_except())) {
                return redirect()->route('access_denied'); 
            }  
        }   

        $attributes = [
            'targetvalue'=>'Target overall value',
            'targetplan'=>'Target plan  [period of time] ',
            'targetreason'=>'Target reason',
            'targetroutine'=>'Target routine  [daily/weekly] ',
            'routineamt'=>'Routine amount  [e.g 2000 daily or weekly] ',
            'bankname'=>'Bank Name',
            'accname'=>'Account Name',
            'accno'=>'Account Number',
        ];

        $validator = Validator()->make($req->all(), [
        'targetvalue'=>'required',
        'targetplan'=>'required',
        'targetreason'=>'required',
        'targetroutine'=>'required',
        'routineamt'=>'required',
        'bankname'=>'required',
        'accname'=>'required',
        'accno'=>'required',
        'clientId'=>'required'
        ],[],$attributes);
       
        if($validator->fails()) {
            return response()->json(['error'=>$validator->errors()->all()]);
        }
        
        $targetSaving = new Target_saving();
        if(Auth()->User()->usr_type=='usr_agent'){
            $targetSaving->agent_id=$agent_id;
        }
        $targetSaving->overall_value=$req['targetvalue'];
        $targetSaving->target_plan=$req['targetplan'];
        $targetSaving->target_reason=$req['targetreason'];
        $targetSaving->target_routine=$req['targetroutine'];
        $targetSaving->routine_amount=$req['routineamt'];
        $targetSaving->bank_name=$req['bankname'];
        $targetSaving->acc_name=$req['accname'];
        $targetSaving->acc_no=$req['accno'];
        $targetSaving->client_id=$req['clientId'];
        $targetSaving->client_no=$req['clientNo'];
        $targetSaving->client_email=$req['clientEmail'];
        $targetSaving->save();
        return ('success');
    }
    
    //return view where you can create a new target saving transaction for the client
    public function targetSavingTransaction(){

        if (!in_array($this->title, parent::app_sections_only())) {    
            return redirect()->route('access_denied'); 
        }

        if (auth()->user()->usr_type=='usr_admin') {
            if (!in_array(__FUNCTION__, parent::middleware_except())) {
                return redirect()->route('access_denied'); 
            }  
        }   

        if((Auth()->User()->usr_type=='usr_client')){
            $client_id=Auth()->User()->user_id;
            $clientTarget=Target_Saving::where('client_id',$client_id)->orderBy('created_at', 'DESC')->get();
            return view('client.client_self_transaction',compact('clientTarget'));
        }
        return view('agent.target_saving_transaction');
    }

    //return all target saving(s) a particular client has 
    public function retrieveTargetRecord(Request $req){
        if (!in_array($this->title, parent::app_sections_only())) {    
            return redirect()->route('access_denied'); 
        }
        $agent_id=Auth()->User()->user_id;

        if (auth()->user()->usr_type=='usr_admin') {
            if (!in_array(__FUNCTION__, parent::middleware_except())) {
                return redirect()->route('access_denied'); 
            }  
        }   

        $clientInfo=$req['clientInfo'];
        $clientTarget = Target_saving::where('client_no','=', $clientInfo)
                    ->orWhere('client_email','=', $clientInfo)->where('agent_id',$agent_id)
                    ->get();
    
        $totalRecord=Target_saving::where('client_no','=', $clientInfo)
        ->orWhere('client_email','=', $clientInfo)
        ->count();

        $noResult='no result';
                    
        if ($totalRecord==0){
            return view('agent\ajax_return_client_target',['clientTarget'=>$noResult]);
        } else{
            return view('agent\ajax_return_client_target',['clientTarget'=>$clientTarget,]);
        }
    }

    //return total amount a client has saved towards the created target
    public function totalAmountPaid(Request $req){
        if (!in_array($this->title, parent::app_sections_only())) {    
            return redirect()->route('access_denied'); 
        }

        if (auth()->user()->usr_type=='usr_admin') {
            if (!in_array(__FUNCTION__, parent::middleware_except())) {
                return redirect()->route('access_denied'); 
            }  
        }   

        $targetSavingId=$req['targetSavingId'];
        $totalPaid=Target_transaction::where('target_saving_id',$targetSavingId)->sum('amount_paid');
        return $totalPaid;
    }

    // this function return the purpose,value, plan and routine(PVPT) of a 
    // target in to the transaction div to be sure of the record they are about to save for
    public function pvpt(Request $req){ 
        if (!in_array($this->title, parent::app_sections_only())) {    
            return redirect()->route('access_denied'); 
        }

        if (auth()->user()->usr_type=='usr_admin') {
            if (!in_array(__FUNCTION__, parent::middleware_except())) {
                return redirect()->route('access_denied'); 
            }  
        } 

        $targetSavingId=$req['targetSavingId'];
        $ppt=Target_saving::find($targetSavingId,['target_plan','overall_value','target_routine',('target_reason'),'routine_amount']);
        //$bankDetails=Target_saving::find($targetSavingId,['target_plan','overall_value','target_routine','target_reason']);
            
        
            echo json_encode($ppt);
        
        
    }

    //this saves all target-saving transaction 
    public function saveTargetTransaction(Request $req){
        if (!in_array($this->title, parent::app_sections_only())) {    
            return redirect()->route('access_denied'); 
        }

        if (auth()->user()->usr_type=='usr_admin') {
            if (!in_array(__FUNCTION__, parent::middleware_except())) {
                return redirect()->route('access_denied'); 
            }  
        }   



        $attributes = [
            'transMethod'=>'Transaction Method',
        ];
        $this->validate($req,[
            'targetId'=>'required',
            'date'=>'required',
            'name'=>'required',
            'amount'=>'required',
            'transMethod'=>'required',
        ],[],$attributes);

        $amount_paid=$req->input('amount');
        $target_saving_id=$req->input("targetId");
        $old_balance=Target_transaction::select('new_balance')->where('target_saving_id',$target_saving_id)
        ->orderBy('transaction_id','DESC')->value('new_balance');
        $new_balance=$old_balance-$amount_paid;
        
        if($old_balance==null){
            $old_balance=Target_saving::where('id',$target_saving_id)->value('overall_value'); 
            $new_balance=$old_balance-$amount_paid;
        }
        
        if($proof=$req->file('proof')){
            $proofName=$proof->getClientOriginalName();
                if($proof->move('transactionReciept',$proofName)){
                    $transaction = new Target_transaction();
                    $transaction->target_saving_id  = $req->input('targetId');
                    $transaction->amount_paid = $req->input('amount');
                    $transaction->new_balance = $new_balance;
                    $transaction->method = $req->input('transMethod');
                    $transaction->creditor_name = $req->input('name');
                    $transaction->payment_date = $req->input('date');
                    $transaction->evidence_transfer_deposit = $proofName;
                    $transaction->save();
                    return redirect()->back()->with(['msg'=>'Transaction Saved']);
                    
                }
        } else {
            $transaction = new Target_transaction();
            $transaction->target_saving_id  = $req->input('targetId');
            $transaction->amount_paid = $req->input('amount');
            $transaction->new_balance = $new_balance;
            $transaction->method = $req->input('transMethod');
            $transaction->creditor_name = $req->input('name');
            $transaction->payment_date = $req->input('date');
            $transaction->save();
            return redirect()->back()->with(['msg'=>'Transaction Saved']);
        }
    }


    //this returns all the target-saving transaction history
    public function clientTransactionDetails($id,$client_id) {

        if (!in_array($this->title, parent::app_sections_only())) {    
            return redirect()->route('access_denied'); 
        }

        if (auth()->user()->usr_type=='usr_admin') {
            if (!in_array(__FUNCTION__, parent::middleware_except())) {
                return redirect()->route('access_denied'); 
            }  
        }   



        $clientTargetTransaction=Target_transaction::where('target_saving_id',$id)->get();
        $clientInfo = Client::where('client_id',$client_id)->get();
        $targetDetail=Target_saving::where('id',$id)->get();
        $totalPaid=Target_transaction::where('target_saving_id',$id)->sum('amount_paid');
        $targetStatus=Target_request::where('target_saving_id',$id)->value('request_status');
        return view ('agent.target_owner_profile',['clientTargetTransaction'=>$clientTargetTransaction,'clientInfo'=>$clientInfo,
        'targetDetail'=>$targetDetail,'totalPaid'=>$totalPaid,'targetStatus'=>$targetStatus]);
    }

    //this return all the target-savings that has requested for pay-back, I'm not done with this function too
    public function allRequestedTarget(){
        if (!in_array($this->title, parent::app_sections_only())) {    
            return redirect()->route('access_denied'); 
        }
      
 
        if (auth()->user()->usr_type=='usr_admin') {
            if (!in_array(__FUNCTION__, parent::middleware_except())) {
                return redirect()->route('access_denied'); 
            }  
        }   

        if(auth()->user()->usr_type=='usr_agent'){
            $agent_id=auth()->user()->user_id;
            $requestTargets=Target_request::where('authorized_request_type','usr_agent')->where('authorized_request',$agent_id)
            ->orderBy('request_date', 'DESC')->orderBy('request_status', 'DESC')->get();

        }else if(auth()->user()->usr_type=='usr_client'){
            $client_id=auth()->user()->user_id;
            $target_saving_id=Target_saving::where('client_id',$client_id)->pluck('id')->toArray();
            $requestTargets=Target_request::wherein('target_saving_id',$target_saving_id)->orderBy('created_at', 'DESC')->get();
        }else{
            $requestTargets=Target_request::orderBy('request_date', 'DESC')->orderBy('request_status', 'DESC')->get();
        }

        
        return view ('Agent\target_request',['requests'=>$requestTargets]);
    }
    

    //this will show a mini report of a client's target-saving history before requesting
    public function miniTransactionReport(Request $req){
        if (!in_array($this->title, parent::app_sections_only())) {    
            return redirect()->route('access_denied'); 
        } 

        if (auth()->user()->usr_type=='usr_admin') {
            if (!in_array(__FUNCTION__, parent::middleware_except())) {
                return redirect()->route('access_denied'); 
            }  
        }   

        $clientInfo=$req['clientInfo'];
        $clientTarget = Target_saving::where('client_no','=', $clientInfo)
                    ->orWhere('client_email','=', $clientInfo)
                    ->get();
    
        $totalRecord=Target_saving::where('client_no','=', $clientInfo)
        ->orWhere('client_email','=', $clientInfo)
        ->count();

        $noResult='no result';
                    
        if ($totalRecord==0){
            return view('agent\ajax_mini_transaction_report',['clientTarget'=>$noResult]);
        } else{
            return view('agent\ajax_mini_transaction_report',['clientTarget'=>$clientTarget,]);
        }
    }

    //return the client bank details from the database
    public function clientBankDetails(Request $req){
        if (!in_array($this->title, parent::app_sections_only())) {    
            return redirect()->route('access_denied'); 
        }

        if (auth()->user()->usr_type=='usr_admin') {
            if (!in_array(__FUNCTION__, parent::middleware_except())) {
                return redirect()->route('access_denied'); 
            }  
        }   

        $idForBankDetails=$req['targetIdBank'];
        $bankDetails=Target_saving::find($idForBankDetails,['bank_name','acc_no','acc_name']);
        return $bankDetails;
    }

    //saves all requested target saving to database
    public function requestTarget(Request $req){
        if (!in_array($this->title, parent::app_sections_only())) {    
            return redirect()->route('access_denied'); 
        }
        
        if (auth()->user()->usr_type=='usr_admin') {
            if (!in_array(__FUNCTION__, parent::middleware_except())) {
                return redirect()->route('access_denied'); 
            }  
        }   

        
        $this->validate($req,[
            'targetId'=>'required',
            'date'=>'required',
            'saved'=>'required',
            'refundMethod'=>'required',
            'bankName'=>'required',
            'accName'=>'required',
            'accNo'=>'required',
        ]);
            
            $target_saving_id=$req['targetId'];
            $checkRequest= Target_request::where('target_saving_id','=',$target_saving_id)->count();
            if($checkRequest==0){
                $reqTarget = new Target_request();
                $reqTarget->target_saving_id=$req['targetId'];
                $reqTarget->request_date=$req['date'];
                $reqTarget->amount_saved=$req['saved'];
                $reqTarget->payment_method=$req['refundMethod'];
                $reqTarget->bank_name=$req['bankName'];
                $reqTarget->acc_no=$req['accNo'];
                $reqTarget->acc_name=$req['accName'];
                $reqTarget->authorized_request=Auth()->User()->user_id;
                $reqTarget->authorized_request_type=Auth()->User()->usr_type;
                $reqTarget->save();
                
                // notify admins of that a target has been requested
                $type = 'new_target_request';
                $agent_id=auth()->user()->user_id;
                $target_saving_id=$req["targetId"];
                $client_id=Target_saving::where('id',$target_saving_id)->value('client_id');
                $purpose=Target_saving::where('id',$target_saving_id)->value('target_reason');
                $request_id=Target_request::where('target_saving_id',$target_saving_id)->value('request_id');$client = Client::where('client_id', $client_id)->first();
                $agent= User::where('user_id', $agent_id)->first();
                
                if(auth()->user()->usr_type=='usr_agent'){
                    $message = '<b>'.ucfirst($agent->username).' ['.$agent_id.']</b> requested for'.$purpose.'target saving on behalf of <b>'.ucfirst($client->last_name).'  '.ucfirst($client->first_name).' ['.$client_id.']</b>';
                    $intiator=$agent_id;
                }else{
                    $message = '<b>'.ucfirst($client->last_name).'  '.ucfirst($client->first_name).' ['.$client_id.']</b> requested for <b>'.$purpose.'</b> target saving';
                    $intiator=$client_id;
                }
                
                
                $admninistrators = User::where('usr_type', 'usr_admin')->get();
                foreach ($admninistrators as $key => $admninistrator) {
                    $notification = Notification::create ([
                        'actor_id'=>$intiator,
                        'receiver_id' => $admninistrator->user_id,
                        'type' => $type,
                        'message' => $message,
                        'status' => 'sent',
                        'main_foreign_key' => $request_id,
                    ]);
                }
                return redirect()->back()->with(['msg'=>'Your Request has been generated successfully, Pending Approval']);
            }else{
                $checkRequest= Target_request::where('target_saving_id','=',$target_saving_id)->value('request_status');
                if($checkRequest=='Pending'){
                    return redirect()->back()->with(['msg'=>'Target has been requested previously, but it\'s still pending approval from Admin']);
                }else if($checkRequest=='In-progress'){
                    return redirect()->back()->with(['msg'=>'Target has been requested previously, transcation is in progress']);
                }else{
                    return redirect()->back()->with(['msg'=>'Target has been requested previously, and pay-back is completed']);
                }
            }
            
    }

    //this will change the status of the requested target depending on if it has been processed but I'm not done with it
    public function changeRequestStatus(Request $req){
        if (!in_array($this->title, parent::app_sections_only())) {    
            return redirect()->route('access_denied'); 
        }
        $authoriseBy=Auth()->User()->username;
        $requestId=$req['targetId'];
        $progress=$req['progress'];
        $today=date("d-m-Y");
        if($progress=='Pending'){
            DB::table('target_requests')
                ->where('target_saving_id', $requestId)
                ->update(['request_status' => 'In-progress','authorized_approval'=>$authoriseBy,'approval_date'=>$today]);
                redirect()->back();
        }else if($progress=='In-progress'){
            DB::table('target_requests')
                ->where('target_saving_id', $requestId)
                ->update(['request_status' => 'Completed','authorized_completion'=>$authoriseBy,'complete_date'=>$today]);
                redirect()->back();
        }else{
            DB::table('target_requests')
                ->where('target_saving_id', $requestId)
                ->update(['request_status' => 'In-progress','authorized_approval'=>$authoriseBy,'approval_date'=>$today,
                        'authorized_completion'=>'','complete_date'=>'']);
                redirect()->back();
        }
    }

    //this function will get a mini update on each requested target
    public function reqReport(Request $req){
        $reqId=$req['reqId'];
        $reqHistory = Target_request::select('authorized_request','authorized_request_type','request_date', 'authorized_approval','approval_date','authorized_completion','complete_date')
                ->where('request_id', $reqId)
                ->get();
        return view('/agent.ajax_targetreq_history',['reqHistory'=>$reqHistory]);
    }



}



