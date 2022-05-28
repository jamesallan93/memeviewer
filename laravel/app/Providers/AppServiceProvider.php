<?php

namespace App\Providers;

use App\Observers\SubscriptionObserver;
use Bpuig\Subby\Models\PlanSubscription;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        PlanSubscription::observe(SubscriptionObserver::class);
    }
}
