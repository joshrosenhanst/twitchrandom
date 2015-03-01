@foreach ($galleries as $gallery)
<div class="col-sm-4 col-xs-12 gallery-item">
    <div class="item">
        <div class="item-image">
            <a href="/stream/{{ $gallery->channel->name }}" class="stream-image">{{ HTML::image($gallery->preview->medium, $gallery->channel->name, array("class"=>"img-thumbnail")) }}</a>
            <a href="/game/{{ $gallery->game }}" class="box-art">{{ HTML::image("http://static-cdn.jtvnw.net/ttv-boxart/".$gallery->game."-40x55.jpg", $gallery->game) }}</a>
        </div>
        <a class="stream-link" href="/stream/{{ $gallery->channel->name }}">
            <h5 class="title">{{ $gallery->channel->status or $gallery->channel->display_name }}</h5>
            <p class="description">{{ $gallery->viewers }} Viewers on {{ $gallery->channel->name }}</p>
        </a>
    </div>
</div>
@endforeach
{{-- <pre>{{ var_dump($galleries) }}</pre> --}}