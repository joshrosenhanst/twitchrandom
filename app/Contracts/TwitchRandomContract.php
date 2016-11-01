<?php

namespace App\Contracts;

interface TwitchRandomContract{
    /* GAMES */
    public function getGameList();
    public function getCachedGameList();
    public function getTopGames($limit, $offset=0);
    public function getGamesBySearch($search,$live = false);
    public function getRandomGame();

    /* STREAMS */
    public function getRandomStreamLink();
    public function getRandomStream();
    public function getGalleryStreams();
    public function getFeaturedStreams($num = 9);
    public function getGameStreams($game=null,$limit);
    public function getGameTopStreams($game);
    public function getStreamByName($name);

    /* USERS */
    public function getUserByName($name);

    /* CHANNELS */
    public function getChannelByName($name);

    /*EMOTES*/
    public function getEmoteList();
}