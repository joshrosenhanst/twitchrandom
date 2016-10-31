<?php
if(isset($stream->channel->status) && strlen($stream->channel->status) > 70){
    $streamname = mb_substr($stream->channel->status,0,70) . "...";
}else{
    $streamname = isset($stream->channel->status)?$stream->channel->status:$stream->channel->display_name;
}
?>

<div class="row stream-details" id="main-stream-container">
    <div class="col-md-8 col-sm-12 stream-cont">
        @if(App::environment('production'))  {{-- Don't embed stream for dev pages --}}
    {{--  src="http://www.twitch.tv/{{ $stream->channel->name }}/embed" --}}
        <iframe
                src="https://player.twitch.tv/?channel={{ $stream->channel->name }}"
                frameborder="0"
                scrolling="no"
                width="100%"
                height="380"
                class="main-stream" id="main-stream"
                auto_play="false"
                autoplay="0"
                autostart="0">

        </iframe>
        {{-- Uncomment to use the swf-object+js; You will also need to uncomment the JS blocks at the bottom of this page;
        <div id="main-stream" class="main-stream"></div>
        <div class="loading" id="inside-stream-loading">
            <img src="/img/loading.gif" alt="loading">
            <span class="text">Loading Stream...</span>
        </div>
        --}}

        {{--Uncomment to use Flash Object--}}
        {{--<object id="main-stream" class="main-stream" type="application/x-shockwave-flash" height="380" width="620" data="http://www.twitch.tv/widgets/live_embed_player.swf?channel={{ $stream->channel->namare }}" bgcolor="#fafafa">
            <param name="allowFullScreen" value="true" />
            <param name="allowScriptAccess" value="always" />
            <param name="allowNetworking" value="all" />
            <param name="width" value="620" />
            <param name="movie" value="http://www.twitch.tv/widgets/live_embed_player.swf" />
        </object>--}}
        @endif
    </div>
    <div class="col-md-4 stream-info">
        <div class="stream-details-container">
            <h2 class="main-title" title="{{ $stream->channel->status or $stream->channel->display_name }}">
                {{ $streamname }}
            </h2>
            <div class="streamer row">
                <div class="col-xs-4 col-md-2">
                    @if($stream->channel->logo)
                    <a class="display-logo" href="/stream/{{ $stream->channel->name }}">
                        <img src="{{ $stream->channel->logo }}" alt="Profile Image - {{ $stream->channel->name }}">
                    </a>
                    @else
                    <a class="display-logo" href="/stream/{{ $stream->channel->name }}">
                        <img src="https://static-cdn.jtvnw.net/ttv-static/404_boxart-50x50.jpg" alt="Default Twitch Profile Image">
                    </a>
                    @endif
                </div>
                <div class="col-xs-8 col-md-10">
                    <div class="display-links">
                        <a class="display-name" href="/stream/{{ $stream->channel->name }}" data-streamlink="{{ $stream->channel->name }}">{{ $stream->channel->display_name }}</a>
                    </div>
                    <div class="display-playing">
                        <p>playing <a href="/games/{{ rawurlencode($stream->channel->game) }}">{{ $stream->game }}</a></p>
                        <p></p>
                    </div>
                </div>
            </div>
            <div class="stream-stats">
                <span class="viewers" title="Current Viewers"><span class="glyphicon glyphicon-user"></span>{{ $stream->viewers }}</span>
                <span class="views" title="Total Views"><span class="glyphicon glyphicon-eye-open"></span>{{ $stream->channel->views }}</span>
                <span class="followers" title="Followers"><span class="glyphicon glyphicon-heart"></span>{{ $stream->channel->followers }}</span>
                <a href="{{ $stream->channel->url }}" class="stream-link btn btn-link"  target="_blank" title="Go To {{ $stream->channel->display_name }} Twitch Channel"><span class="glyphicon glyphicon-link"></span>Channel</a>
            </div>
        </div>
        @if(isset($game))
        <a href="/randomstream" title="Go To a Random {{$game}} Stream" class="btn btn-twitch" id="randomize-stream">Random {{$game}} Stream</a>
        @else
        <a href="/randomstream" title="Go To a Random Stream" class="btn btn-twitch btn-lg" id="randomize-stream">Random Stream</a>
        @endif
        <script>
            $(document).ready(function(){
                @if($slogan)
                $(".slogan").text("{!! $random_text !!}");
                @endif

                @if($stream->channel->profile_banner)
                $(".jumbocontainer").css("background-image", "url('{{ $stream->channel->profile_banner }}')");
                @else
                $(".jumbocontainer").css("background-image", "none");
                @endif
            });
        </script>
    </div>
</div>
{{-- <pre>{{ var_dump($stream) }}</pre> --}}
