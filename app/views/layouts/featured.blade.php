<div class="row">
@foreach ($galleries as $gallery)
<div class="gallery-item">
    <div class="item">
        <div class="item-image">
            <a href="/stream/{{ $gallery->stream->channel->name }}">{{ HTML::image($gallery->stream->preview->medium, $gallery->stream->channel->status or $gallery->stream->channel->display_name, array("class"=>"img-thumbnail")) }}</a>
            <a href="/game/{{ $gallery->stream->game }}" class="box-art">{{ HTML::image("http://static-cdn.jtvnw.net/ttv-boxart/".$gallery->stream->game."-40x55.jpg", $gallery->stream->game) }}</a>
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