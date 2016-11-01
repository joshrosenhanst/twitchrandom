<?php

namespace App;

use App\Packages\Twitch;
use App\Packages\TwitchEmote;
use Cache;
use App\Contracts\TwitchRandomContract;

class TwitchRandom implements TwitchRandomContract{
    protected $twitch;

    public function __construct(){
        $this->twitch = new Twitch(array(
            'client_id' => env('TWITCH_CLIENT_ID'),
            'client_secret' => env('TWITCH_CLIENT_SECRET'),
            'redirect_uri' => env('TWITCH_AUTH_REDIRECT'),
        ));
        $this->twitchEmote = new TwitchEmote();
    }

    /* GAMES*/
    public function getGameList(){
        if(env('OFFLINE')){
            return [
                array(
                    "name"=>"Team Fortress 2",
                    "img"=>NULL
                ),
                array(
                    "name"=>"Dota 2",
                    "img"=>NULL
                )
            ];
        }else{
            $games = $this->twitch->gamesTop(100);
            $list = array();
            foreach($games->top as $game){
                //array_push($list, $game->game->name);
                $list[] = array(
                    "name"=>$game->game->name,
                    "img"=>$game->game->logo->small
                );
            }
            return $list;
        }
    }

    public function getCachedGameList(){
        $games_list = Cache::remember('games_list', 5, function(){
            return $this->getGameList();
        });

        return $games_list;
    }

    public function getTopGames($limit, $offset=0){
        return $this->twitch->gamesTop($limit,$offset);
    }

    public function getGamesBySearch($search,$live = false){
        return $this->twitch->gamesSearch($search,$live);
    }

    public function getRandomGame(){
        $games_list = Cache::remember('games_list', 5, function(){
            return $this->getGameList();
        });
        return $games_list[array_rand($games_list,1)]["name"];
    }

    /* STREAMS */
    public function getRandomStreamLink(){
        return $this->getRandomStream()->channel->name;
    }

    /*
     * getRandomStream()
     * grab 1 random live stream. Only to be used for main page.
     */
    public function getRandomStream(){
        $stream = $this->twitch->getStreams(null,1,rand(1,8000),null,true);
        return $stream->streams[0];
    }

    /*
     * getGalleryStreams()
     * grab 3 arrays of live streams using 3 random offsets, optionally filtered by game. Merge and then shuffle the array.
     * Only used for the main page, because game pages probably wont be able to get enough live streams to match the random criteria.
     * Maybe use the beta random for this?
    */
    public function getGalleryStreams(){
        $streams = $this->twitch->getRandomStreams();
        return array_slice($streams->streams,0,11);

        /*$streams1 = $this->twitch->getStreams(null,4,rand(1,400),null,true);
        $streams2 = $this->twitch->getStreams(null,4,rand(401,6000),null,true);
        $streams3 = $this->twitch->getStreams(null,3,rand(6001,8000),null,true);
        $streams = array_merge($streams1->streams,$streams2->streams,$streams3->streams);
        shuffle($streams);
        return $streams;*/
    }

    public function getFeaturedStreams($num = 9){
        $streams = $this->twitch->streamsFeatured($num);
        return $streams->featured;
    }

    /*
     * To be used for game page. Grab 100 of the first page of streams for a specific game. Then randomly sort that array and use the 1st (or first 9 for gallery page)
     */
    public function getGameStreams($game=null,$limit){
        $game = rawurldecode($game);
        $obj = $this->twitch->getStreams($game,100,0,null,true);
        shuffle($obj->streams);
        return array_slice($obj->streams, 0, $limit);
    }

    public function getGameTopStreams($game){
        $game = rawurldecode($game);
        $obj = $this->twitch->getStreams($game,9,0,null,true);
        return $obj->streams;
    }

    public function getStreamByName($name){
        $name = rawurldecode($name);
        return $this->twitch->streamGet($name);
    }

    /* USERS */
    public function getUserByName($name){
        $name = rawurldecode($name);
        return $this->twitch->userGet($name);
    }

    /* CHANNELS */
    public function getChannelByName($name){
        $name = rawurldecode($name);
        return $this->twitch->channelGet($name);
    }

    /* EMOTES */
    public function getEmoteList(){
        $emote_list = Cache::remember('emote_list', $this->twitchEmote->cacheTime, function(){
            return $this->twitchEmote->getGlobalList();
        });
        return $emote_list->emotes;
    }
}