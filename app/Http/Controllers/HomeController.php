<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Redirect;

class HomeController extends Controller
{
    public function home(){
        return view('index', array(
        ));
    }

    public function missing(){
        return view('404', array(
        ));
    }
    public function randomstream(){
        $stream = $this->twitchrandom->getRandomStreamLink();
        return Redirect::to("/stream/".rawurlencode($stream));
    }

    public function stream($name){
        $name = rawurldecode($name);
        return view('stream', array(
            "name"=>$name,
        ));
    }
}
