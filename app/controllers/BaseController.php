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

    public function getRandomGame(){
        $games = array("Dota 2", "Starbound", "League of Legends", "Team Fortress 2", "Minecraft");
        return $games[array_rand($games,1)];
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

    public function getGalleryStreams(){
        /*
         * getGalleryStreams()
         * grab 3 arrays of live streams using 3 random offsets, optionally filtered by game. Merge and then shuffle the array.
         * Only used for the main page, because game pages probably wont be able to get enough live streams to match the random criteria.
         * Maybe use the beta random for this?
        */
        $twitch = new TwitchSDK;
       /* $a = $twitch->getStreams(null,3,rand(800,2000),null,true);
        $b = $twitch->getStreams(null,3,rand(1,100),null,true);
        $c = $twitch->getStreams(null,3,rand(101,799),null,true);
        $streams = array_merge($a->streams,$b->streams,$c->streams);
        shuffle($streams);
        $total = $twitch->getStreams(null,1,0,null,true)->_total;
        echo "<pre>";
        var_dump($total);
        echo "</pre>";*/
        /*$total = $twitch->getStreams(null,1,0,null,true)->_total;
        $offset = $total?(rand(0,$total/9)):0;
        var_dump($offset);
        $streams = $twitch->getStreams(null,9,$offset,null,true);*/
        $streams = $twitch->getRandomStreams();
        return array_slice($streams->streams,0,9);
        //return $streams->streams;
    }

    public function getFeaturedStreams($num = 9){
        $twitch = new TwitchSDK;
        $streams = $twitch->streamsFeatured($num);
        return $streams->featured;
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

    public function getGameTopStreams($game){
        $twitch = new TwitchSDK;
        $obj = $twitch->getStreams($game,9,0,null,true);
        return $obj->streams;
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