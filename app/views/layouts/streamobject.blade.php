{{-- FLASH OBJECT --}}
{{-- <div class="stream-container">
    <object class="main-stream" type="application/x-shockwave-flash" height="378" width="620" id="live_embed_player_flash" data="http://www.twitch.tv/widgets/live_embed_player.swf?channel={{ $name }}" bgcolor="#fafafa">
        <param name="allowFullScreen" value="true" />
        <param name="allowScriptAccess" value="always" />
        <param name="allowNetworking" value="all" />
        <param name="width" value="640" />
        <param name="movie" value="http://www.twitch.tv/widgets/live_embed_player.swf" />
        <param name="flashvars" value="hostname=www.twitch.tv&channel={{ $name }}&auto_play=false&start_volume=25" />
    </object>
</div> --}}

{{-- HTML5 iframe --}}
<div class="stream-details">
    <iframe src="http://www.twitch.tv/{{{ $stream->channel->name }}}/embed" frameborder="0" scrolling="no" width="728" height="450" class="main-stream" auto_play="false" autoplay="0" autostart="0"></iframe>
        <h2 class="main-title">{{{ $stream->channel->status or $stream->channel->display_name }}}</h2>
        <p class="main-details">
            <a class="display-name" href="{{{ $stream->channel->url }}}">{{ $stream->channel->display_name }}</a> playing <a href="/game/{{{ $stream->channel->game }}}">{{{ $stream->game }}}</a> <span class="viewers">{{ $stream->viewers }} Viewers</span>
        </p>
    @if($stream->channel->profile_banner)
    <script>
        $(document).ready(function(){
            $(".jumbocontainer").css("background-image", "url('{{{ $stream->channel->profile_banner }}}')");
        })
    </script>
</div>
@endif
{{-- <pre>{{ var_dump($stream) }}</pre> --}}
