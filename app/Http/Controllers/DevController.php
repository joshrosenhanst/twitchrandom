<?php

use App\Packages\Twitch;

class DevController extends Controller {

    protected $twitch;

    public function __construct(Twitch $twitch){
        $this->twitch = $twitch;
    }

    public function mobiletest(){
        return View::make('layouts.dev.mobiletest', array(
        ));
    }

    public function twitch($limit=100, $offset=0){
        var_dump($this->twitch->gamesTop($limit,$offset));
        return "twitch";
        //return $this->twitch->get();
        //$t = new \App\Packages\Twitch;

        //var_dump($this->twitch->gamesTop(100,0));
        //return "twitch";
        //return $this->test();
    }
}