<?php
namespace App\Services;

class SmsService{
    public function sendSms($phone,$message){
        $client = new \IPPanel\Client(config('services.sms.api_key'));
        $client->send(
            config('services.sms.originator_number'),          // originator
            [$phone],    // recipients
            $message,
            'description'
        );
    }
}

