<?php
namespace App\Services;

use App\Models\Smsverify;

class SmsVerification{
    public function __construct()
    {

    }

    public function is_verified($number){
        return (Smsverify::where('phone',$number)->where('is_verified',1)->first() ? true:false);
    }

    public function verifyNumber($record){
        $max_time = (int)ceil(config('services.sms.sendAgainInSeconde')/60);
        if(($record->updated_at ?? $record->created_at)>(now()->subMinutes($max_time))){
            $record->is_verified = 1;
            $record->update();
            return 'your phone verified successfully';
        }
        return 'time out';
    }



}


