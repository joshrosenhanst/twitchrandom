<?php

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Packages\Twitch;

abstract class Controller extends BaseController
{
    use DispatchesJobs, ValidatesRequests;

    protected $twitch;

    public function __construct(Twitch $twitch){
        $this->twitch = $twitch;
    }

    public function getRandomText(){
        $array = Lang::get('main.slogans');
        return $array[array_rand($array)];
    }

    public function getGameList(){
        $games = $this->twitch->gamesTop(100);
        $list = array();
        foreach($games->top as $game){
            //array_push($list, $game->game->name);
            $list[] = array(
              "name"=>$game->game->name,
              "img"=>$game->game->logo->small
            );
        }
        return $list;
    }
}
