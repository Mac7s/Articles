<?php

namespace App\Http\Controllers;

use App\Events\VerifyNumber;
use App\Http\Requests\VerifySmsRequest;
use App\Models\Smsverify;
use App\Services\SmsVerificationSend;
use Illuminate\Http\Request;

class SmsverifyController extends Controller
{
    public function askForVerify(VerifySmsRequest $request){

        $request->authenticate();
        $exist_model =(new Smsverify)->existNumberInDatabase($request->phone);
        $message =(new SmsVerificationSend($exist_model,$request->phone))->sendVerification();
        return response()->json([
            'message'=> $message
        ]);
    }


    public function VerifyNumber(Request $request){
        $request->validate([
            'verification_code'=>'required',
            'phone' => 'required'
        ]);
        $record =Smsverify::where('phone',$request->phone)
                    ->where('verification_code',$request->verification_code)
                    ->first();
        // dd($record);
        if($record && !($record->created_at<now()->subMinutes(3))){
            $record->is_verified = 1;
            $record->update();
            return response()->json([
                'message'=>'your phone verified successfully'
            ]);
        }
        return response()->json([
            'message'=>'time out please try again'
        ]);
    }
}
