<?php

namespace App\Services;

use App\Mail\SubscribedEmail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use  Sichikawa\LaravelSendgridDriver\SendGrid;

class SendGridService
{
    use SendGrid;
    protected $send_grid, $template_id;

    public function __construct()
    {
        $this->send_grid = new \SendGrid\Mail\Mail();
        $this->template_id = "d-cd6de2568b8145e8a64359551f91e5f8";
    }
    public function SendEmail($payload)
    {
        try {
            Mail::to($payload['email'])->send(new SubscribedEmail($payload));
        } catch (\Throwable $th) {
            Log::warning("SendGridService@SendEmail::error");

            Log::error($th->getMessage());

            throw $th;
        }
    }
}
