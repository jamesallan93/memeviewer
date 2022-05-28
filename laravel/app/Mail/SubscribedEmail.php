<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Sichikawa\LaravelSendgridDriver\SendGrid;

class SubscribedEmail extends Mailable
{
    use Queueable, SerializesModels;

    use SendGrid;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $payload;

    public function __construct($payload)
    {
        $this->payload = $payload;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        Log::debug("payload in email");
        Log::debug($this->payload);

        return $this
            ->view([])
            ->subject($this->payload['subject'])
            ->from(env('MAIL_FROM_ADDRESS'))
            ->to([$this->payload['email']])
            ->sendgrid([
                'personalizations' => [
                    [
                        'dynamic_template_data' =>  $this->payload
                    ],
                ],
                'template_id' => "d-cd6de2568b8145e8a64359551f91e5f8",
            ]);
    }
}
