<?php

class GameController extends Controller {

    public function home(){
        return View::make('games.home', array(
            "games_list"=>$this->getCachedGameList(),
            "random_text"=>$this->getRandomText()
        ));
    }

    public function getGame($game){
        $game = rawurldecode($game);
        return View::make('games.game', array(
            "game"=>$game,
            "games_list"=>$this->getCachedGameList(),
            "random_text"=>$this->getRandomText()
        ));
    }

}
