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
<div class="row stream-details" id="main-stream-container">
    <div class="col-md-8 stream-cont">
        <iframe src="http://www.twitch.tv/{{{ $stream->channel->name }}}/embed" frameborder="0" scrolling="no" width="620" height="380" class="main-stream" auto_play="false" autoplay="0" autostart="0"></iframe>
    </div>
    <div class="col-md-4 stream-info">
        <h2 class="main-title">{{{ $stream->channel->status or $stream->channel->display_name }}}</h2>
        <div class="streamer">
            @if($stream->channel->logo)
            <a class="display-logo" href="{{{ $stream->channel->url }}}"><img src="{{{ $stream->channel->logo }}}"></a>
            @endif
            <a class="display-name" href="{{{ $stream->channel->url }}}">{{ $stream->channel->display_name }}</a>
            <div class="display-playing">
                playing <a href="/game/{{{ $stream->channel->game }}}">{{{ $stream->game }}}</a>
            </div>
        </div>
        <div class="stream-stats">
            <span class="viewers"><span class="glyphicon glyphicon-user"></span>{{ $stream->viewers }}</span>
            <span class="views"><span class="glyphicon glyphicon-eye-open"></span>{{ $stream->channel->views }}</span>
            <span class="followers"><span class="glyphicon glyphicon-heart"></span>{{ $stream->channel->followers }} </span>
        </div>
        <button class="btn btn-twitch btn-lg" id="randomize-stream">Randomize Stream</button>
        @if($stream->channel->profile_banner)
        <script>
            $(document).ready(function(){
                $(".jumbocontainer").css("background-image", "url('{{{ $stream->channel->profile_banner }}}')");
            })
        </script>
        @endif
    </div>
</div>
{{-- <pre>{{ var_dump($stream) }}</pre> --}}
