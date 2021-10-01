<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 
use App\Models\Client;
use App\Models\User;
use App\Models\Target_saving;

class TargetSavingController extends Controller
{
    //
    public function allTargetAccount(){
        $data=Target_saving::orderBy('created_at', 'DESC')->get();
         //dd($data);
    //    $dat= print_r($data);
    //    dd($dat);
        return view ('Agent\target_saving',['data'=>$data]);
    }

    public function searchClientUsingNumber(Request $req){
        
        $phoneNo=$req['phone'];
        $client = Client::where('phone',$phoneNo)->first();
        
        return view ('agent\ajax_target_form',['existingClient'=>$client]);
    }

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
        $targetSaving->save();
        return ('success');
    }
}
