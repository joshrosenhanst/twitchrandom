<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Slogan;
use App\Contracts\TwitchRandomContract;
use Cache;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(TwitchRandomContract $twitchrandom)
    {
        view()->share('random_text', $this->getRandomSlogan());
        view()->share('games_list', $twitchrandom->getGameList());
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Contracts\TwitchRandomContract', 'App\TwitchRandom');
    }

    public function getRandomSlogan(){
        $approved = Slogan::where("approved","=",1)->get();
        $plucked = $approved->pluck("slogan");
        $array = $plucked->all();
        return $array[array_rand($array)];
    }
}
