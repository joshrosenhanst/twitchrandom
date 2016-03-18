<?php

class HomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function home(){
		return View::make('index', array(
            "games_list"=>$this->getCachedGameList(),
            "random_text"=>$this->getRandomText()
        ));
	}

	public function missing(){
		return View::make('404', array(
            "games_list"=>$this->getCachedGameList(),
            "random_text"=>$this->getRandomText()
        ));
	}
	public function randomgame(){
		$game = $this->getRandomGame();
        return Redirect::to("/games/".rawurlencode($game));
	}
	public function randomstream(){
		$stream = $this->getRandomStreamLink();
        return Redirect::to("/stream/".rawurlencode($stream));
	}

    public function stream($name){
        $name = rawurldecode($name);
        return View::make('stream', array(
            "name"=>$name,
            "games_list"=>$this->getCachedGameList(),
            "random_text"=>$this->getRandomText()
        ));
    }
}