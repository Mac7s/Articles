<?php

namespace App\Listeners;

use App\Events\VerifyNumber;
use App\Services\SmsService;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendVerificationSms
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\VerifyNumber  $event
     * @return void
     */
    public function handle(VerifyNumber $event)
    {
        $message = "your verification code is : {$event->verification_code}";
        (new SmsService)->sendSms($event->number,$message);
    }
}
