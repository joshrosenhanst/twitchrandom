@extends('layouts.wrapper')

@section('title')
<title>Mobile Test | TwitchRandom</title>
@stop

@section('css')
<link rel="stylesheet" href="/css/main.min.css">
@stop

@section('js')
@stop


@section('content')
<h1>Flash Embed</h1>
<object id="main-stream" class="main-stream" type="application/x-shockwave-flash" height="380" width="620" data="http://www.twitch.tv/widgets/live_embed_player.swf?channel=shogun_gambinos" bgcolor="#fafafa">
    <param name="allowFullScreen" value="true" />
    <param name="allowScriptAccess" value="always" />
    <param name="allowNetworking" value="all" />
    <param name="width" value="620" />
    <param name="movie" value="http://www.twitch.tv/widgets/live_embed_player.swf" />
</object>

<h1>IFrame</h1>
<iframe src="http://www.twitch.tv/shogun_gambinos/embed" frameborder="0" scrolling="no" width="620" height="380" class="main-stream" id="main-stream" auto_play="false" autoplay="0" autostart="0"></iframe>

<h1>swfobject js</h1>

<div id="swfobject_test" class="main-stream"></div>
<script>

    $(document).ready(function(){
        window.onPlayerEvent = function (data) {
            data.forEach(function(event) {
            });
        };
        swfobject.embedSWF("//www-cdn.jtvnw.net/swflibs/TwitchPlayer.swf", "swfobject_test", "620", "380", "11", null,
        { "eventsCallback":"onPlayerEvent",
            "embed":1,
            "channel":"shogun_gambinos",
            "auto_play":"true"},
        { "allowScriptAccess":"always",
            "allowFullScreen":"true"
        });
    });
</script>
@stop