<?php
namespace App\Services;

use Exception;
use App\Models\Smsverify;
use App\Events\VerifyNumber;

class SmsVerificationSend{


    private $rand_number;

    public function __construct(public $exist_model,public string $phone)
    {
        $this->rand_number = random_int(164123,978942);
    }

    public function sendVerification(){
        if(!$this->exist_model){
            $this->newVerification();
            VerifyNumber::dispatch($this->phone,$this->rand_number);
        }

        $this->updateVerification();
        VerifyNumber::dispatch($this->phone,$this->rand_number);
        return "please enter your verification code in ". ceil(config('services.sms.sendAgainInSeconde')/60) ." min";
    }


    private function updateVerification(){
        $this->exist_model->verification_code = $this->rand_number;
        $this->exist_model->update();
    }

    private function newVerification(){
            $new_sms = new Smsverify;
            $new_sms->phone = $this->phone;
            $new_sms->verification_code =$this->rand_number;
            $new_sms->save();
    }


}


