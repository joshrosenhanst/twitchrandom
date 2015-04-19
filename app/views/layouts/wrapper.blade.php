<!doctype HTML>
<html>
<head>
    @yield("title")
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">
    @yield("css")
</head>
<body>
    @yield("content")
    <script src="//code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/swfobject/2.2/swfobject.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
    <script src="/js/nicescroll.min.js"></script>
    <script src="/js/jquery.history.js"></script>
    @yield("js")
    @if(Config::get('app.showStream')) {{-- Don't use analytics for dev pages --}}
    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-61997617-1', 'auto');
        ga('require', 'linkid', 'linkid.js');
        ga('send', 'pageview');

    </script>
    @endif
</body>
</html>