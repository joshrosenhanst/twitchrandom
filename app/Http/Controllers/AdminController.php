<?php

use Illuminate\Http\Request;


class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return View::make('admin', array(
            "games_list" => $this->getCachedGameList(),
            "random_text" => $this->getRandomText()
        ));
    }
}