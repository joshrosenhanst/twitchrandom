<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;


class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('admin', array(
            "games_list" => $this->getCachedGameList(),
            "random_text" => $this->getRandomText()
        ));
    }
}