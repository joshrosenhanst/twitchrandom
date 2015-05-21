<div class="row">
@foreach ($galleries as $gallery)
<div class="gallery-item col-sm-4 col-xs-12">
    <div class="item">
        <div class="item-image">
            <a href="/stream/{{ $gallery->stream->channel->name }}">{{ HTML::image($gallery->stream->preview->medium, ("Featured Stream: ".htmlentities($gallery->stream->channel->status)), array("class"=>"img-thumbnail")) }}</a>
            <a href="/games/{{ $gallery->stream->game }}" class="box-art">{{ HTML::image("http://static-cdn.jtvnw.net/ttv-boxart/".$gallery->stream->game."-40x55.jpg", (htmlentities($gallery->stream->game)." - Box Art")) }}</a>
        </div>
        <a class="stream-link" href="/stream/{{ $gallery->stream->channel->name }}">
            <h5 class="title">{{ $gallery->stream->channel->status or $gallery->stream->channel->display_name }}</h5>
            <p class="description">{{ $gallery->stream->viewers }} Viewers on {{ $gallery->stream->channel->name }}</p>
        </a>
    </div>
</div>
@endforeach
</div>
{{-- <pre>{{ var_dump($galleries) }}</pre> --}}