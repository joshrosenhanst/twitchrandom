<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

class AjaxController extends Controller {
    public function randomStream($slogan=false){
        $stream = $this->twitchrandom->getRandomStream();
        if(isset($stream->error)){
            return view('layouts.error', array(
                "errorMsg"=>$stream->message,
            ));
        }else{
            return view('layouts.streamobject', array(
                "stream"=> $stream,
                "slogan"=>$slogan,
                //"random_text"=>$this->getRandomText()
            ));
        }
    }

    public function getStreamInfo($name){
        $name = rawurldecode($name);
        $stream = $this->twitchrandom->getStreamByName($name);
        if(isset($stream->error)){
            return view('layouts.error', array(
                "name"=>$name,
                "errorMsg"=>$stream->message,
            ));
        }else{
            return view('layouts.streampopup', array(
                "name"=>$name,
                "stream"=>$stream->stream,
            ));
        }
    }

    public function streamByName($name,$slogan = false){
        $name = rawurldecode($name);
        $stream = $this->twitchrandom->getStreamByName($name);
        if(isset($stream->error)){
            return view('layouts.error', array(
                "name"=>$name,
                "errorMsg"=>$stream->message,
            ));
        }else{
            return view('layouts.streamobject', array(
                "name"=>$name,
                "stream"=>$stream->stream,
                "slogan"=>$slogan,
                //"random_text"=>$this->getRandomText()
            ));
        }
    }
    public function streamsByGame($game,$limit,$slogan = false){
        $game = rawurldecode($game);
        $stream = $this->twitchrandom->getGameStreams($game,$limit);

        if(isset($stream->error)){
            return view('layouts.error', array(
                "game"=>$game,
                "errorMsg"=>$stream->message
            ));
        }else{
            if($limit === "1"){
                //stream
                if($stream){
                    return view('layouts.streamobject', array(
                        "game"=>$game,
                        "stream"=>$stream[0],
                        "slogan"=>$slogan,
                    ));
                }else{
                    return view('layouts.error', array(
                        "game"=>$game,
                        "errorMsg"=>"Game '".$game."' not found",
                    ));
                }
            }else{
                //galleries
                return view('layouts.gallery', array(
                    "galleries"=>$stream,
                    "button"=>true
                ));
            }
        }
    }

    public function topStreamsByGame($game){
        $game = rawurldecode($game);
        return view('layouts.gallery', array(
            "galleries"=>$this->twitchrandom->getGameTopStreams($game),
            "button"=>false
        ));
    }

    public function getGallery(){
        return view('layouts.gallery', array(
            "galleries"=>$this->twitchrandom->getGalleryStreams(),
            "button"=>true
        ));
    }

    public function getFeaturedGallery($num=9){
        return view('layouts.featured', array(
            "galleries"=>$this->twitchrandom->getFeaturedStreams($num),
            "button"=>false
        ));
    }

    public function getAllGames($limit, $offset=0){
        return view('layouts.allgames', array(
            "games"=>$this->twitchrandom->getTopGames($limit,$offset)
        ));
    }

    public function searchGames($search){
        $games = $this->twitchrandom->getGamesBySearch($search, true);
        $array = array();
        foreach($games->games as $game){
            $array[$game->name] = "/games/".rawurlencode($game->name);
        }
        //return Response::json($array);
        return response()->json($array);
    }

}