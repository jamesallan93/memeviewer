<?php

namespace App\Http\Controllers;

use App\Models\User;
use Bpuig\Subby\Models\Plan;
use Illuminate\Http\Request;


class HomeController extends Controller
{
    protected $user;

    public function __construct()
    {
        $this->middleware('auth');

        $this->user = new User();

        $this->plans = new Plan();
    }


    public function index()
    {
        $user = $this->user->find(auth()->user()->id);

        $plans = $this->plans->all();

        $memes_imgs = $this->displayMemesByPlan($user);

        return view('home', compact(['user', 'plans', 'memes_imgs']));
    }


    public function displayMemesByPlan($user)
    {
        if (!$user->subscriptions->count()) return [];
        $can_use = $user->subscription('main')->canUseFeature('meme');

        $plan_id = $user->subscription()->plan_id;

        $plan = $this->plans->find($plan_id);

        $memes_array = [
            "https://img-9gag-fun.9cache.com/photo/aYrdXWv_700bwp.webp",
            "https://img-9gag-fun.9cache.com/photo/aWgd3Yx_460swp.webp",
            "https://img-9gag-fun.9cache.com/photo/aKmLow1_700bwp.webp",
            "https://img-9gag-fun.9cache.com/photo/a41xOYA_700bwp.webp",
            "https://img-9gag-fun.9cache.com/photo/aVxd63d_700bwp.webp",
            "https://img-9gag-fun.9cache.com/photo/aDDPvEx_700bwp.webp"
        ];
        $meme_total = count($memes_array);

        if ($can_use) {

            $memes_quanity = $plan->getFeatureByTag('meme')->value;

            $resolved_memes = [];

            for ($i = 0; $i < $memes_quanity; $i++) {
                array_push($resolved_memes, $memes_array[rand(1, $meme_total - 1)]);
            }

            return $resolved_memes;
        }
    }
}
