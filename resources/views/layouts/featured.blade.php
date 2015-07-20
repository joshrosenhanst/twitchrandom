<div class="row">
@foreach ($galleries as $gallery)
<div class="gallery-item col-sm-4 col-xs-12">
    <div class="item">
        <div class="item-image">
            <a href="/stream/{{ $gallery->stream->channel->name }}"><img src="{{ $gallery->stream->preview->medium }}" alt="Random Stream: {{ htmlentities($gallery->stream->channel->status) }}" class="img-thumbnail"></a>
            <a href="/games/{{ $gallery->stream->game }}" class="box-art"><img src="http://static-cdn.jtvnw.net/ttv-boxart/{{ $gallery->stream->game  }}-40x55.jpg" alt="{{ htmlentities($gallery->stream->game) }} - Box Art"></a>
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