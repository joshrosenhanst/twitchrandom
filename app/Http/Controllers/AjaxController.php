<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class AjaxController extends Controller {
    public function randomStream($slogan=false){
        //$stream = $this->getRandomStream();
        $stream = $this->twitch->getStreams(null,1,rand(1,8000),null,true)->streams[0];
        if(isset($stream->error)){
            return view('layouts.error', array(
                "errorMsg"=>$stream->message,
            ));
        }else{
            return view('layouts.streamobject', array(
                "stream"=> $stream,
                "slogan"=>$slogan,
                "random_text"=>$this->getRandomText()
            ));
        }
    }

    public function getStreamInfo($name){
        $name = rawurldecode($name);
        //$stream = $this->getStreamByName($name);
        $stream = $this->twitch->streamGet($name);
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
        //$stream = $this->getStreamByName($name);
        $stream = $this->twitch->streamGet($name);
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
                "random_text"=>$this->getRandomText()
            ));
        }
    }
    public function streamsByGame($game,$limit,$slogan = false){
        //$stream = $this->getRandomStream($game);
        $game = rawurldecode($game);
        //$stream = $this->getGameStreams($game,$limit);
        $obj = $this->twitch->getStreams($game,100,0,null,true);
        shuffle($obj->streams);
        $stream =  array_slice($obj->streams, 0, $limit);

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
                        "random_text"=>$this->getRandomText()
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
            //"galleries"=>$this->getGameTopStreams($game),
            "galleries"=>$this->twitch->getStreams($game,9,0,null,true)->streams,
            "button"=>false
        ));
    }

    public function getGallery(){
        return view('layouts.gallery', array(
            //"galleries"=>$this->getGalleryStreams(),
            "galleries"=>array_slice($this->twitch->getRandomStreams()->streams,0,11),
            "button"=>true
        ));
    }

    public function getFeaturedGallery($num=9){
        return view('layouts.featured', array(
            //"galleries"=>$this->getFeaturedStreams($num),
            "galleries"=>$this->twitch->streamsFeatured($num)->featured,
            "button"=>false
        ));
    }

    public function getAllGames($limit, $offset=0){
        return view('layouts.allgames', array(
            //"games"=>$this->getTopGames($limit,$offset)
            "games"=>$this->twitch->gamesTop($limit,$offset)
        ));
    }

    public function searchGames($search){
        //$games = $this->getGamesBySearch($search, true);
        $games = $this->twitch->gamesSearch($search,true);
        $array = array();
        foreach($games->games as $game){
            $array[$game->name] = "/games/".rawurlencode($game->name);
        }
        return Response::json($array);
    }

}