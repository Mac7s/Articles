<?php

namespace App\Http\Controllers;

use App\Events\VerifyNumber;
use App\Models\Smsverify;
use Illuminate\Http\Request;

class SmsverifyController extends Controller
{
    public function askForVerify(Request $request){
        $request->validate([
            'phone'=>['required','starts_with:+98','size:13']
        ]);
        $exist_model = Smsverify::where('phone',$request->phone)->first();
        if($exist_model){
            $creating_model_timestamp = $exist_model->updated_at->timestamp ?? $exist_model->created_at->timestamp;
            $now_timestamp = now()->timestamp;
            $remain_seconds_for_new_request = $now_timestamp-$creating_model_timestamp;
            if($remain_seconds_for_new_request<30){
                return response()->json([
                    'message'=>"please try $remain_seconds_for_new_request second later"
                ]);
            }
        }

        $rand_number = random_int(164123,978942);
        if(!$exist_model){
            $new_sms = new Smsverify;
            $new_sms->phone = $request->phone;
            $new_sms->verification_code =$rand_number;
            $new_sms->save();
        }else{
            if($exist_model->is_verified){
                return response()->json([
                    'message'=>'you verified before'
                ]);
            }
            $exist_model->verification_code = $rand_number;
            $exist_model->update();
        }
        VerifyNumber::dispatch($request->phone,$rand_number);
        return response()->json(['message'=>'your verification code send to you please enter it in 5 minutes']);

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
