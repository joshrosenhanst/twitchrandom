<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Redirect;

class GameController extends Controller {

    public function home(){
        return view('games.home', array(
        ));
    }

    public function getGame($game){
        $game = rawurldecode($game);
        return view('games.game', array(
            "game"=>$game,
        ));
    }

    public function randomgame(){
        $game = $this->twitchrandom->getRandomGame();
        return Redirect::to("/games/".rawurlencode($game));
    }

}
