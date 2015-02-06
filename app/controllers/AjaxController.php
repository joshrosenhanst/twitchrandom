<?php

class AjaxController extends BaseController {

    public function randomStream(){
        return View::make('layouts.streamobject', array(
            "stream"=> $this->getRandomStream()
        ));
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

    public function getGallery(){
        return View::make('layouts.gallery', array(
            "galleries"=>$this->getGalleryStreams()
        ));
    }

}