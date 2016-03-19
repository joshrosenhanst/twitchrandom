<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class GameController extends Controller {

    public function home(){
        return view('games.home', array(
            "games_list"=>$this->getCachedGameList(),
            "random_text"=>$this->getRandomText()
        ));
    }

    public function getGame($game){
        $game = rawurldecode($game);
        return view('games.game', array(
            "game"=>$game,
            "games_list"=>$this->getCachedGameList(),
            "random_text"=>$this->getRandomText()
        ));
    }

}
