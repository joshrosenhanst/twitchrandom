<?php

class GameController extends BaseController {

    public function home(){
        return View::make('games.home');
    }

    public function getGame($game){
        return View::make('games.game', array(
            "game"=>$game
        ));
    }

}
