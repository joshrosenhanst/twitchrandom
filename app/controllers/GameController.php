<?php

class GameController extends BaseController {

    public function home(){
        $games_list = Cache::remember('games_list', 5, function(){
            return $this->getGameList();
        });
        return View::make('games.home', array(
            "games_list"=>$games_list,
            "random_text"=>$this->getRandomText()
        ));
    }

    public function getGame($game){
        $games_list = Cache::remember('games_list', 5, function(){
            return $this->getGameList();
        });
        $game = rawurldecode($game);
        return View::make('games.game', array(
            "game"=>$game,
            "games_list"=>$games_list,
            "random_text"=>$this->getRandomText()
        ));
    }

}
