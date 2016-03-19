<?php
namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use Cache;

use App\Packages\Twitch;
use App\Slogan;

abstract class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $twitch;

    public function __construct(Twitch $twitch){
        $this->twitch = $twitch;
    }

    public function getRandomText(){
        //$array = Lang::get('main.slogans');
        //$array = App\Slogan::where("approved","=",1)->get("slogan");
        //$array = $array->toArray();
        $approved = Slogan::where("approved","=",1)->get();
        $plucked = $approved->pluck("slogan");
        $array = $plucked->all();
        return $array[array_rand($array)];
    }

    public function getRandomGame(){
        $games_list = Cache::remember('games_list', 5, function(){
            return $this->getGameList();
        });
        return $games_list[array_rand($games_list,1)]["name"];
    }

    public function getRandomStreamLink(){
        return $this->getRandomStream()->channel->name;
    }

    public function getRandomStream(){
        /*
         * getRandomStream()
         * grab 1 random live stream. Only to be used for main page.
         */
        $stream = $this->twitch->getStreams(null,1,rand(1,8000),null,true);
        return $stream->streams[0];
    }

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

    public function getGalleryStreams(){
        /*
         * getGalleryStreams()
         * grab 3 arrays of live streams using 3 random offsets, optionally filtered by game. Merge and then shuffle the array.
         * Only used for the main page, because game pages probably wont be able to get enough live streams to match the random criteria.
         * Maybe use the beta random for this?
        */
        //$twitch = new TwitchSDK;
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
        $streams = $this->twitch->getRandomStreams();
        return array_slice($streams->streams,0,11);
        //return $streams->streams;
    }

    public function getFeaturedStreams($num = 9){
        $streams = $this->twitch->streamsFeatured($num);
        return $streams->featured;
    }

    public function getGameStreams($game=null,$limit){
        /*
         * To be used for game page. Grab 100 of the first page of streams for a specific game. Then randomly sort that array and use the 1st (or first 9 for gallery page)
         */
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
    public function getUserByName($name){
        $name = rawurldecode($name);
        return $this->twitch->userGet($name);
    }

    public function getChannelByName($name){
        $name = rawurldecode($name);
        return $this->twitch->channelGet($name);
    }

    public function getTopGames($limit, $offset=0){
        return $this->twitch->gamesTop($limit,$offset);
    }

    public function getGamesBySearch($search,$live = false){
        return $this->twitch->gamesSearch($search,$live);
    }
}