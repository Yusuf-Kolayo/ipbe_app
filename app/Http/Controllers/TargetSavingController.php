<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 
use App\Models\Client;
use App\Models\User;
use App\Models\Target_saving;
use App\Models\Target_transaction;
use App\Models\Target_request;

class TargetSavingController extends Controller
{
    //this returns all targets created from database
    public function allTargetAccount(){
        $allTargets=Target_saving::orderBy('created_at', 'DESC')->get();
        return view ('Agent\target_saving',['data'=>$allTargets]);
    }

    //this is use check if client's information exist on database before creating target
    public function searchClientUsingNumber(Request $req){      
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

   

    //return view of the page you can check a client target saving history
    public function targetSavingTransaction(){
        return view('agent.target_saving_transaction');
    }

    //return target saving(s) a client started
    public function retrieveTargetRecord(Request $req){
        $clientInfo=$req['clientInfo'];
        $clientTarget = Target_saving::where('client_no','=', $clientInfo)
                    ->orWhere('client_email','=', $clientInfo)
                    ->get();
    
        $totalRecord=Target_saving::where('client_no','=', $clientInfo)
        ->orWhere('client_email','=', $clientInfo)
        ->count();

        $noResult='no result';
                    
        if ($totalRecord==0){
            return view('agent\ajax_created_target',['clientTarget'=>$noResult]);
        } else{
            return view('agent\ajax_created_target',['clientTarget'=>$clientTarget,]);
        }
    }

    //return total amount a client has saved towards the created target
    public function totalAmountPaid(Request $req){
        $targetSavingId=$req['targetSavingId'];
        $totalPaid=Target_transaction::where('target_saving_id',$targetSavingId)->sum('amount_paid');
        return $totalPaid;
    }

    //this saves any target-saving transaction that happens
    public function saveTargetTransaction(Request $req){
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
        
        if($proof=$req->file('proof')){
            $proofName=$proof->getClientOriginalName();
                if($proof->move('transactionReciept',$proofName)){
                    $transaction = new Target_transaction();
                    $transaction->target_saving_id  = $req->input('targetId');
                    $transaction->amount_paid = $req->input('amount');
                    $transaction->method = $req->input('transMethod');
                    $transaction->creditor_name = $req->input('name');
                    $transaction->payment_date = $req->input('date');
                    $transaction->evidence_transfer_deposit = $proofName;
                    $transaction->save();
                    return redirect()->back()->with(['msg'=>'Transaction Saved']);
                    
                }
        }else{
            $transaction = new Target_transaction();
            $transaction->target_saving_id  = $req->input('targetId');
            $transaction->amount_paid = $req->input('amount');
            $transaction->method = $req->input('transMethod');
            $transaction->creditor_name = $req->input('name');
            $transaction->payment_date = $req->input('date');
            $transaction->save();
            return redirect()->back()->with(['msg'=>'Transaction Saved']);
        }
    }

    //this returns all the target-saving transaction history
    public function clientTransactionDetails($id,$client_id){
        $clientTargetTransaction=Target_transaction::where('target_saving_id',$id)->get();
        $clientInfo = Client::where('client_id',$client_id)->get();
        $targetDetail=Target_saving::where('id',$id)->get();
        $totalPaid=Target_transaction::where('target_saving_id',$id)->sum('amount_paid');
        return view ('agent.target_owner_profile',['clientTargetTransaction'=>$clientTargetTransaction,'clientInfo'=>$clientInfo,
        'targetDetail'=>$targetDetail,'totalPaid'=>$totalPaid]);
    }

    //this return all the target-saving that has been requested for by the client, I'm not done with this function too
    public function allRequestedTarget(){
        // $requestTargets=Target_saving::join('target_requests','target_requests.request_id','=','target_savings.id')
        // ->orderBy('request_date', 'DESC')
        // ->get();
        $requestTargets=Target_request::all();
        // foreach ($requestTargets as $key => $value) { echo $value->target_saving;
        //     # code...
        // }  die();
        //dd($requestTargets);
        return view ('Agent\target_request',['requests'=>$requestTargets]);
    }

    //this will show a mini report of a client's target-saving history before requesting
    public function miniTransactionReport(Request $req){
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
        $idForBankDetails=$req['targetIdBank'];
        $bankDetails=Target_saving::find($idForBankDetails,['bank_name','acc_no','acc_name']);
        return $bankDetails;
    }

    //saves all requested target saving to database
    public function requestTarget(Request $req){
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
                $reqTarget->save();
                return redirect()->back()->with(['msg'=>'Your Request has been generated successfully, Pending Approval']);
            }else{
                return redirect()->back()->with(['msg'=>'Target has been requested previously, pay-back is in progress']);
            }
            
    }

    //this will change the status of the requested target depending on if it has been processed but I'm not done with it
    public function changeRequestStatus($id){
        $status=Target_request::find($id);
        $status->request_status='Completed';
        $status->save();
    }

}


