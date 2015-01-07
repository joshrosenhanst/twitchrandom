<?php

class GameController extends BaseController {

    public function home()
    {
        return View::make('games.home');
    }
    public function getGame($name)
    {
        return View::make('games.game');
    }

}
