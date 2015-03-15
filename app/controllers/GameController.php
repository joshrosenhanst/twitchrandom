<?php

class GameController extends BaseController {

    public function home(){
        return View::make('games.home');
    }

    public function getGame($game){
        $games_list = Cache::remember('games_list', 5, function(){
            return $this->getGameList();
        });
        $game = urldecode($game);
        return View::make('games.game', array(
            "game"=>$game,
            "games_list"=>$games_list
        ));
    }

}
