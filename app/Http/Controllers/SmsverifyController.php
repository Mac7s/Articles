<?php

namespace App\Http\Controllers;

use App\Events\VerifyNumber;
use App\Http\Requests\VerifyNumberRequest;
use App\Http\Requests\VerifySmsRequest;
use App\Models\Smsverify;
use App\Services\SmsVerification;
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


    public function VerifyNumber(VerifyNumberRequest $request){
        $record = Smsverify::where('phone',$request->phone)
                            ->where('verification_code',$request->verification_code)
                            ->firstOrFail();

        $response = (new SmsVerification())->verifyNumber($record);
        return response()->json([
            'message'=>$response
        ]);
    }
}
