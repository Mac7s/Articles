<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class VerifyNumber
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $number;
    public $verification_code;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(string $number , string $verification_code)
    {
        $this->number = $number;
        $this->verification_code = $verification_code;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
