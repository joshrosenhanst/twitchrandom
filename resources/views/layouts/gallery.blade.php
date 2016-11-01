<div class="gallery-holder">
    <div class="gallery-cont row">
        @foreach ($galleries as $gallery)
        <div class="gallery-item col-sm-4 col-md-3">
            <div class="item">
                <div class="item-image">
                    <a href="/stream/{{ rawurlencode($gallery->channel->name) }}" class="stream-image"><img src="{{ $gallery->preview->medium }}" alt="Random Stream: {{ $gallery->channel->status or $gallery->channel->display_name }}" class="img-thumbnail"></a>
                    <a href="/games/{{ $gallery->game }}" class="box-art"><img src="https://static-cdn.jtvnw.net/ttv-boxart/{{ $gallery->game  }}-40x55.jpg" alt="{{ $gallery->game }} - Box Art"></a>
                </div>
                <a class="stream-link" href="/stream/{{ rawurlencode($gallery->channel->name) }}">
                    <h5 class="title">{{ $gallery->channel->status or $gallery->channel->display_name }}</h5>
                    <p class="description"><span class="viewers"><span class="glyphicon glyphicon-eye-open"></span> {{ $gallery->viewers }}</span> on {{ $gallery->channel->name }}</p>
                </a>
            </div>
        </div>
        @endforeach
        @if($button)
        <button class="gallery-reload btn btn-lg btn-twitch col-sm-4 col-md-3">
            Randomize Gallery
        </button>
        @endif
    </div>
</div>
{{-- <pre>{{ var_dump($galleries) }}</pre> --}}