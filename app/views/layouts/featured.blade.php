@foreach ($galleries as $gallery)
<div class="col-sm-4 col-xs-12 gallery-item">
    <div class="item">
        <a href="/stream/{{ $gallery->stream->channel->name }}">{{ HTML::image($gallery->stream->preview->medium, "", array("class"=>"img-thumbnail")) }}</a>
        <a class="stream-link" href="/stream/{{ $gallery->stream->channel->name }}">
            <h5 class="title">{{ $gallery->stream->channel->status or $gallery->stream->channel->display_name }}</h5>
            <p class="description">{{ $gallery->stream->viewers }} Viewers on {{ $gallery->stream->channel->name }}</p>
        </a>
    </div>
</div>
@endforeach
{{-- <pre>{{ var_dump($galleries) }}</pre> --}}