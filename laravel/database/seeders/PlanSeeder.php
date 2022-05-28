<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Bpuig\Subby\Models\Plan;
use Bpuig\Subby\Models\PlanFeature;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $plans_contents = [
            [
                'tag' => 'basic',
                'name' => 'Single',
                'description' => 'You can see 1 meme',
                'price' => 100.00,
                'signup_fee' => 0,
                'invoice_period' => 1,
                'invoice_interval' => 'month',
                'trial_period' => 0,
                'trial_interval' => 'day',
                'tier' => 1,
                'currency' => 'BRL',
            ],
            [
                'tag' => 'medium',
                'name' => 'Dual',
                'description' => 'You can see 2 memes',
                'price' => 400.00,
                'signup_fee' => 50.00,
                'invoice_period' => 1,
                'invoice_interval' => 'month',
                'trial_period' => 0,
                'trial_interval' => 'day',
                'tier' => 1,
                'currency' => 'BRL',
            ],
        ];

        foreach ($plans_contents as $index => $plan) {
            $plan =  Plan::create($plan);
            $plan->features()->saveMany([
                new PlanFeature(['tag' => 'meme', 'name' => 'Memes', 'value' => $index + 1, 'sort_order' => $index, 'description' => $index + 1 . " memes to have fun"])
            ]);
        }
    }
}
