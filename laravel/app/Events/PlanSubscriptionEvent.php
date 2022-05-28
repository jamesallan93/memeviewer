<?php

namespace App\Events;

use App\Services\SendGridService;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PlanSubscriptionEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public $sendgrid, $payload;

    public function __construct($payload)
    {
        $this->sendgrid = new SendGridService();
        $this->payload = $payload;
    }

    public function handle()
    {
        $this->sendgrid->SendEmail($this->payload);
    }
}
