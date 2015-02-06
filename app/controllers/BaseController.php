<?php

use \ritero\SDK\TwitchTV\TwitchSDK;


class BaseController extends Controller {
	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

    public function getRandomStream(){
        /*
         * getRandomStream()
         * grab 1 random live stream.
         */
        $twitch = new TwitchSDK;
        $stream = $twitch->getStreams(null,1,rand(1,8000),null,true);
        return $stream->streams[0];
    }

    public function getGalleryStreams(){
        /*
         * getGalleryStreams()
         * grab 3 arrays of live streams using 3 random offsets. Merge and then shuffle the array.
        */
        $twitch = new TwitchSDK;
        //return $twitch->channelGet('giantwaffle');
        //$streams = $twitch->streamsFeatured(9);
        $a = $twitch->getStreams(null,3,rand(800,2000),null,true);
        $b = $twitch->getStreams(null,3,rand(1,100),null,true);
        $c = $twitch->getStreams(null,3,rand(101,799),null,true);
        $streams = array_merge($a->streams,$b->streams,$c->streams);
        shuffle($streams);
        return $streams;
    }

    public function getStreamByName($name){
        $twitch = new TwitchSDK;
        return $twitch->streamGet($name);
    }
    public function getUserByName($name){
        $twitch = new TwitchSDK;
        return $twitch->userGet($name);
    }

    public function getChannelByName($name){
        $twitch = new TwitchSDK;
        return $twitch->channelGet($name);
    }

}