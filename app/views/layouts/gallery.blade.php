@foreach ($galleries as $gallery)
<div class="col-sm-4 col-xs-12">
    <div class="item">
        <a href="/stream/{{ $gallery->channel->name }}">{{ HTML::image($gallery->preview->medium, "", array("class"=>"img-thumbnail")) }}</a>
        <a class="stream-link" href="/stream/{{ $gallery->channel->name }}">
            <h5 class="title">{{ $gallery->channel->status or $gallery->channel->display_name }}</h5>
            <p class="description">{{ $gallery->viewers }} Viewers on {{ $gallery->channel->name }}</p>
        </a>
    </div>
</div>
@endforeach
<pre>{{ var_dump($galleries) }}</pre>