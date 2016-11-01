<!DOCTYPE html>
<?php /* <html lang="en"> */ ?>
<html lang="en" xml:lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php echo $__env->yieldContent("meta"); ?>
    <meta name="robots" content="index,follow,noarchive" />
    <meta name="author" content="SpoonCo">

    <?php /* FAVICONS */ ?>
    <link href="/favicon.ico" rel="shortcut icon" type="image/x-icon">

    <?php /* PRECONNECT */ ?>
    <link href="https://player.twitch.tv" rel="preconnect">
    <link href="https://static-cdn.jtvnw.net" rel="preconnect">
    <link href="web-cdn.ttvnw.net" rel="preconnect">
    <link href="https://spade.twitch.tv" rel="preconnect">
    <link href="https://pubster.twitch.tv" rel="preconnect">
    <link href="https://api.twitch.tv" rel="preconnect">

    <?php echo $__env->yieldContent("title"); ?>

    <?php if(env('OFFLINE',true)): ?>
    <link rel="stylesheet" href="/css/offline/bootstrap.min.css">
    <?php /* <link rel="stylesheet" href="/css/offline/bootstrap-theme.min.css"> */ ?>
    <?php else: ?>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <?php /* <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous"> */ ?>
    <?php endif; ?>
    <?php /*no internet */ ?>

    <link rel="stylesheet" href="/css/main.css">
    <?php echo $__env->yieldContent("css"); ?>

    <?php if(!env('OFFLINE',true)): ?>
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <?php endif; ?>
</head>
<body>
    <?php echo $__env->yieldContent("content"); ?>
    <?php if(env('OFFLINE', true)): ?>
    <script src="/js/offline/jquery.js"></script>
    <script src="/js/offline/bootstrap.min.js"></script>
    <?php else: ?>
    <?php /*<script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>*/ ?>
    <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <?php endif; ?>
    <?php /*<script src="//ajax.googleapis.com/ajax/libs/swfobject/2.2/swfobject.js"></script>*/ ?>
    <script src="/js/nicescroll.min.js"></script>
    <script src="/js/jquery.history.js"></script>
    <?php /*<script src="//twemoji.maxcdn.com/2/twemoji.min.js"></script>*/ ?>
    <?php echo $__env->yieldContent("js"); ?>
    <?php if(App::environment('production')): ?> <?php /* Don't use analytics for dev pages */ ?>
    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-61997617-1', 'auto');
        ga('send', 'pageview');

    </script>
    <?php endif; ?>
    <?php /*<script>
        twemoji.parse(document.body, {
            folder: 'svg',
            ext: '.svg',
            callback: function(icon, options, variant) {
                switch ( icon ) {
                    case 'a9':      // © copyright
                    case 'ae':      // ® registered trademark
                    case '2122':    // ™ trademark
                        return false;
                }
                return ''.concat(options.base, options.size, '/', icon, options.ext);
            }
        });
    </script>*/ ?>
</body>
</html>