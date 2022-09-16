<?php
namespace App\Services;

use App\Models\Smsverify;

class SmsVerification{
    public function __construct(public string $number)
    {

    }

    public function is_verified(){
        return (Smsverify::where('phone',$this->number)->where('is_verified',1)->first() ? true:false);
    }

    public function sendVerificationCode(){
        
    }


}


