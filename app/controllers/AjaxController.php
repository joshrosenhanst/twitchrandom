<?php

class AjaxController extends BaseController {
    public function randomStream(){
        $stream = $this->getRandomStream();
        if(isset($stream->error)){
            return View::make('layouts.error', array(
                "errorMsg"=>$stream->message,
            ));
        }else{
            return View::make('layouts.streamobject', array(
                "stream"=> $stream
            ));
        }
    }

    public function streamByName($name){
        $stream = $this->getStreamByName($name);
        if(isset($stream->error)){
            return View::make('layouts.error', array(
                "name"=>$name,
                "errorMsg"=>$stream->message,
            ));
        }else{
            return View::make('layouts.streamobject', array(
                "name"=>$name,
                "stream"=>$stream->stream,
            ));
        }
    }
    public function streamsByGame($game,$limit){
        //$stream = $this->getRandomStream($game);
        $stream = $this->getGameStreams($game,$limit);
        if(isset($stream->error)){
            return View::make('layouts.error', array(
                "game"=>$game,
                "errorMsg"=>$stream->message,
            ));
        }else{
            if($limit === "1"){
                //stream
                return View::make('layouts.streamobject', array(
                    "game"=>$game,
                    "stream"=>$stream[0],
                ));
            }else{
                //galleries
                return View::make('layouts.gallery', array(
                    "galleries"=>$stream
                ));
            }
        }
    }

    public function topStreamsByGame($game){
        return View::make('layouts.gallery', array(
            "galleries"=>$this->getGameTopStreams($game)
        ));
    }

    public function getGallery(){
        return View::make('layouts.gallery', array(
            "galleries"=>$this->getGalleryStreams()
        ));
    }

    public function getFeaturedGallery($num=9){
        return View::make('layouts.featured', array(
            "galleries"=>$this->getFeaturedStreams($num)
        ));
    }

}