<?php

use App\Packages\Twitch;

class DevController extends Controller {

    protected $twitch;

    public function __construct(Twitch $twitch){
        $this->twitch = $twitch;
    }

    public function mobiletest(){
        return view('layouts.dev.mobiletest', array(
        ));
    }

    public function twitch($limit=100, $offset=0){
        var_dump($this->twitchrandom->getTopGames($limit,$offset));
        return "twitch";
    }
}