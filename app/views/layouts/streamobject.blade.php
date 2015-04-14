{{-- FLASH OBJECT --}}
{{-- <div class="stream-container">
    <object class="main-stream" type="application/x-shockwave-flash" height="360" width="640" id="live_embed_player_flash" data="http://www.twitch.tv/widgets/live_embed_player.swf?channel={{ $name }}" bgcolor="#fafafa">
        <param name="allowFullScreen" value="true" />
        <param name="allowScriptAccess" value="always" />
        <param name="allowNetworking" value="all" />
        <param name="width" value="640" />
        <param name="movie" value="http://www.twitch.tv/widgets/live_embed_player.swf" />
        <param name="flashvars" value="hostname=www.twitch.tv&channel={{ $name }}&auto_play=false&start_volume=25" />
    </object>
</div> --}}

{{-- HTML5 iframe --}}
<?php
if(isset($stream->channel->status) && strlen($stream->channel->status) > 70){
    $streamname = mb_substr($stream->channel->status,0,70) . "...";
}else{
    $streamname = isset($stream->channel->status)?$stream->channel->status:$stream->channel->display_name;
}
?>
<div class="row stream-details" id="main-stream-container">
    <div class="col-md-8 stream-cont">
        @if(Config::get('app.showStream'))
        <iframe src="http://www.twitch.tv/{{{ $stream->channel->name }}}/embed" frameborder="0" scrolling="no" width="620" height="380" class="main-stream" auto_play="false" autoplay="0" autostart="0"></iframe>
        @endif
    </div>
    <div class="col-md-4 stream-info">
        <div class="stream-details-container">
            <h2 class="main-title" title="{{{ $stream->channel->status or $stream->channel->display_name }}}">
                {{{ $streamname }}}
            </h2>
            <div class="streamer row">
                <div class="col-sm-2">
                    @if($stream->channel->logo)
                    <a class="display-logo" href="/stream/{{{ $stream->channel->name }}}"><img src="{{{ $stream->channel->logo }}}"></a>
                    @else
                    <a class="display-logo" href="/stream/{{{ $stream->channel->name }}}"><img src="http://static-cdn.jtvnw.net/ttv-static/404_boxart-50x50.jpg"></a>
                    @endif
                </div>
                <div class="col-sm-10">
                    <div class="display-links">
                        <a class="display-name" href="/stream/{{{ $stream->channel->name }}}" data-streamlink="{{{ $stream->channel->name }}}">{{{ $stream->channel->display_name }}}</a>
                    </div>
                    <div class="display-playing">
                        <p>playing <a href="/games/{{{ rawurlencode($stream->channel->game) }}}">{{{ $stream->game }}}</a></p>
                        <p><a class="stream-link" title="{{{ $stream->channel->display_name }}} Twitch Channel" href="{{{ $stream->channel->url }}}" target="_blank"><span class="glyphicon glyphicon-link"></span> Twitch Channel</a></p>
                    </div>
                </div>
            </div>
            <div class="stream-stats col-sm-9">
                <span class="viewers" title="Current Viewers"><span class="glyphicon glyphicon-user"></span>{{ $stream->viewers }}</span>
                <span class="views" title="Total Views"><span class="glyphicon glyphicon-eye-open"></span>{{ $stream->channel->views }}</span>
                <span class="followers" title="Followers"><span class="glyphicon glyphicon-heart"></span>{{ $stream->channel->followers }} </span>
            </div>
        </div>
        @if(isset($game))
        <a href="/randomstream" title="Go To a Random {{{$game}}} Stream" class="btn btn-twitch" id="randomize-stream">Random {{{$game}}} Stream</a>
        @else
        <a href="/randomstream" title="Go To a Random Stream" class="btn btn-twitch btn-lg" id="randomize-stream">Random Stream</a>
        @endif
        @if($stream->channel->profile_banner)
        <script>
            $(document).ready(function(){
                $(".jumbocontainer").css("background-image", "url('{{{ $stream->channel->profile_banner }}}')");
            })
        </script>
        @else
        <script>
            $(document).ready(function(){
                $(".jumbocontainer").css("background-image", "none");
            })
        </script>
        @endif
    </div>
</div>
{{-- <pre>{{ var_dump($stream) }}</pre> --}}
