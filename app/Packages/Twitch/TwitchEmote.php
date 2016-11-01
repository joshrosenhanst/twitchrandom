<?php
namespace App\Packages;

class TwitchEmote {
    public $cacheTime = "30";

    const BASE_URL = "https://twitchemotes.com/api_cache/v2/";
    const BASE_IMAGE_URL = "https://static-cdn.jtvnw.net/emoticons/v1/";
    const GLOBAL_EMOTICONS = "global.json";
    const SUBSCRIBER_EMOTICONS = "subscriber.json";
    const EMOTE_SET_MAPPING = "sets.json";
    const IMAGE_ID_MAPPING = "images.json";
    const SMALL_IMAGE = "/1.0";
    const MEDIUM_IMAGE = "/2.0";
    const LARGE_IMAGE = "/3.0";

    public function __construct(){
        if (!in_array('curl', get_loaded_extensions())) {
            throw new TwitchException('cURL extension is not installed and is required');
        }
    }

    public function getImageURL($imageID,$size = "small"){
        if(isset($imageID)){
            switch(strtolower($size)){
                case "large":
                    $size = self::LARGE_IMAGE;
                    break;
                case "medium":
                    $size = self::MEDIUM_IMAGE;
                    break;
                case "small":
                default:
                    $size = self::SMALL_IMAGE;
                    break;
            }
            return self::BASE_IMAGE_URL . $imageID . $size;
        }else{
            throw new TwitchException('Image ID not provided');
        }
    }

    public function getGlobalList(){
        $global_emoticons_url = self::BASE_URL . self::GLOBAL_EMOTICONS;

        return json_decode(utf8_encode(file_get_contents($global_emoticons_url)));
    }
}