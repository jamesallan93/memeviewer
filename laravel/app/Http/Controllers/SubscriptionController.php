<?php

namespace App\Http\Controllers;

use App\Services\SubscriptionService;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    protected $subscription;

    public function __construct()
    {
        $this->middleware('auth');

        $this->subscription = new SubscriptionService();
    }

    public function subscribeTo($plan_id)
    {
        $data = $this->subscription->subscribeToPlanById($plan_id);

        return redirect('/home');
    }
}
