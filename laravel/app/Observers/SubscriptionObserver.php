<?php

namespace App\Observers;

use App\Events\PlanSubscriptionEvent;
use App\Models\User;
use App\Services\SendGridService;
use Bpuig\Subby\Models\Plan;
use Bpuig\Subby\Models\PlanSubscription;

class SubscriptionObserver
{
    public function created(PlanSubscription $subscription)
    {
        //send email$ plan->getFeatureByTag('meme')
        $user = User::find($subscription->subscriber_id);
        $plan =  Plan::find($subscription->plan_id);
        $payload = [
            "subject" => "You subscribed to the plan $plan->name",
            "email" => $user->email,
            "header" => "Thx for the subscription, have fun with 9gag memes",
            "started_at" => "Subscribed at: {$user->subscription()->starts_at->format('M, d Y')}",
            "ends_at" => "Subscription ends at: {$user->subscription()->ends_at->format('M, d Y')}",
            "plan_name" => "The plan selected: $plan->name",
            "message" => "A big thanks",
        ];
        $sendgrid = new SendGridService();

        $sendgrid->SendEmail($payload);
    }
}
