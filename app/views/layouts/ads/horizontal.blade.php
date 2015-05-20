@if(Config::get('app.showStream'))  {{-- Don't show ads for dev pages --}}
<div class="ad horizontal">
    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <!-- TwitchRandom Responsive Ad - Horizontal -->
    <ins class="adsbygoogle"
         style="display:block"
         data-ad-client="ca-pub-1737596577801120"
         data-ad-slot="6490371140"
         data-ad-format="auto"></ins>
    <script>
        (adsbygoogle = window.adsbygoogle || []).push({});
    </script>
</div>
@endif