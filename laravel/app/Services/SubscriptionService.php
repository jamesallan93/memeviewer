<?php

namespace App\Services;

use Bpuig\Subby\Models\Plan;

use Bpuig\Subby\Models\PlanSubscription;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SubscriptionService
{
    protected $plan, $plan_subscription;

    public function __construct()
    {
        $this->plan = new Plan();
        $this->plan_subscription = new PlanSubscription();
    }


    public function subscribeToPlanById($id)
    {
        try {
            //code...
            $user = auth()->user();

            DB::beginTransaction();

            $message  = "You already subscribed to this plan.";

            if (!$user->isSubscribedTo($id)) {

                $plan = $this->plan->find($id);

                if (count($user->subscriptions) === 0) {

                    $message = $user->newSubscription("main", $plan, "$plan->name subscription", "Customer $plan->name subscription");
                } else {

                    $sub_id = $user->subscription()->id;

                    $subscription = $this->plan_subscription->find($sub_id);

                    $message = $subscription->changePlan($plan);
                }
            }
            DB::commit();
            return $message;
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error("SubscriptionService@subscribeToPlanById::error");

            Log::error($th);

            throw $th;
        }
    }
}
