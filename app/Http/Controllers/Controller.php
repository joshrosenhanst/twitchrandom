<?php
namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;

use App\Contracts\TwitchRandomContract;
use Cache;
use App\Slogan;

class Controller extends BaseController
{
    use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;

    public function __construct(TwitchRandomContract $twitchrandom){
        $this->twitchrandom = $twitchrandom;
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
}