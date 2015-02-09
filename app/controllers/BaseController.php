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
         * grab 1 random live stream. Only to be used for main page.
         */
        $twitch = new TwitchSDK;
        $stream = $twitch->getStreams(null,1,rand(1,8000),null,true);
        return $stream->streams[0];
    }

    public function getBetaRandomStream(){
        /*
         * getBetaRandomStream()
         * grab 1 random live stream -- uses twitch's beta random API.
         */
        $twitch = new TwitchSDK;
        $stream = $twitch->getRandomStreams();
        return $stream->streams[0];
    }

    public function getGalleryStreams($game = null){
        /*
         * getGalleryStreams()
         * grab 3 arrays of live streams using 3 random offsets, optionally filtered by game. Merge and then shuffle the array.
         * Only used for the main page, because game pages probably wont be able to get enough live streams to match the random criteria.
        */
        $twitch = new TwitchSDK;
        $a = $twitch->getStreams($game,3,rand(800,2000),null,true);
        $b = $twitch->getStreams($game,3,rand(1,100),null,true);
        $c = $twitch->getStreams($game,3,rand(101,799),null,true);
        $streams = array_merge($a->streams,$b->streams,$c->streams);
        shuffle($streams);
        return $streams;
    }

    public function getGameStreams($game=null,$limit){
        /*
         * To be used for game page. Grab 100 of the first page of streams for a specific game. Then randomly sort that array and use the 1st (or first 9 for gallery page)
         */
        $twitch = new TwitchSDK;
        $obj = $twitch->getStreams($game,100,0,null,true);
        shuffle($obj->streams);
        return array_slice($obj->streams, 0, $limit);
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