<?php
if(isset($stream->channel->status) && strlen($stream->channel->status) > 70){
    $streamname = mb_substr($stream->channel->status,0,70) . "...";
}else{
    $streamname = isset($stream->channel->status)?$stream->channel->status:$stream->channel->display_name;
}
?>

<div class="row stream-details" id="main-stream-container">
    <div class="col-md-8 col-sm-12 stream-cont">
        <?php if(App::environment('production')): ?>  <?php /* Don't embed stream for dev pages */ ?>
    <?php /*  src="http://www.twitch.tv/<?php echo e($stream->channel->name); ?>/embed" */ ?>
        <iframe
                src="https://player.twitch.tv/?channel=<?php echo e($stream->channel->name); ?>"
                frameborder="0"
                scrolling="no"
                width="100%"
                height="380"
                class="main-stream" id="main-stream"
                auto_play="false"
                autoplay="0"
                autostart="0">

        </iframe>
        <?php /* Uncomment to use the swf-object+js; You will also need to uncomment the JS blocks at the bottom of this page;
        <div id="main-stream" class="main-stream"></div>
        <div class="loading" id="inside-stream-loading">
            <img src="/img/loading.gif" alt="loading">
            <span class="text">Loading Stream...</span>
        </div>
        */ ?>

        <?php /*Uncomment to use Flash Object*/ ?>
        <?php /*<object id="main-stream" class="main-stream" type="application/x-shockwave-flash" height="380" width="620" data="http://www.twitch.tv/widgets/live_embed_player.swf?channel=<?php echo e($stream->channel->namare); ?>" bgcolor="#fafafa">
            <param name="allowFullScreen" value="true" />
            <param name="allowScriptAccess" value="always" />
            <param name="allowNetworking" value="all" />
            <param name="width" value="620" />
            <param name="movie" value="http://www.twitch.tv/widgets/live_embed_player.swf" />
        </object>*/ ?>
        <?php endif; ?>
    </div>
    <div class="col-md-4 stream-info">
        <div class="stream-details-container">
            <h2 class="main-title" title="<?php echo e(isset($stream->channel->status) ? $stream->channel->status : $stream->channel->display_name); ?>">
                <?php echo e($streamname); ?>

            </h2>
            <div class="streamer row">
                <div class="col-xs-4 col-md-2">
                    <?php if($stream->channel->logo): ?>
                    <a class="display-logo" href="/stream/<?php echo e($stream->channel->name); ?>">
                        <img src="<?php echo e($stream->channel->logo); ?>" alt="Profile Image - <?php echo e($stream->channel->name); ?>">
                    </a>
                    <?php else: ?>
                    <a class="display-logo" href="/stream/<?php echo e($stream->channel->name); ?>">
                        <img src="https://static-cdn.jtvnw.net/ttv-static/404_boxart-50x50.jpg" alt="Default Twitch Profile Image">
                    </a>
                    <?php endif; ?>
                </div>
                <div class="col-xs-8 col-md-10">
                    <div class="display-links">
                        <a class="display-name" href="/stream/<?php echo e($stream->channel->name); ?>" data-streamlink="<?php echo e($stream->channel->name); ?>"><?php echo e($stream->channel->display_name); ?></a>
                    </div>
                    <div class="display-playing">
                        <p>playing <a href="/games/<?php echo e(rawurlencode($stream->channel->game)); ?>"><?php echo e($stream->game); ?></a></p>
                        <p></p>
                    </div>
                </div>
            </div>
            <div class="stream-stats">
                <span class="viewers" title="Current Viewers"><span class="glyphicon glyphicon-user"></span><?php echo e($stream->viewers); ?></span>
                <span class="views" title="Total Views"><span class="glyphicon glyphicon-eye-open"></span><?php echo e($stream->channel->views); ?></span>
                <span class="followers" title="Followers"><span class="glyphicon glyphicon-heart"></span><?php echo e($stream->channel->followers); ?></span>
                <a href="<?php echo e($stream->channel->url); ?>" class="stream-link btn btn-link"  target="_blank" title="Go To <?php echo e($stream->channel->display_name); ?> Twitch Channel"><span class="glyphicon glyphicon-link"></span>Channel</a>
            </div>
        </div>
        <?php if(isset($game)): ?>
        <a href="/randomstream" title="Go To a Random <?php echo e($game); ?> Stream" class="btn btn-twitch" id="randomize-stream">Random <?php echo e($game); ?> Stream</a>
        <?php else: ?>
        <a href="/randomstream" title="Go To a Random Stream" class="btn btn-twitch btn-lg" id="randomize-stream">Random Stream</a>
        <?php endif; ?>
        <script>
            $(document).ready(function(){
                <?php if($slogan): ?>
                $(".slogan").text("<?php echo $random_text; ?>");
                <?php endif; ?>

                <?php if($stream->channel->profile_banner): ?>
                $(".jumbocontainer").css("background-image", "url('<?php echo e($stream->channel->profile_banner); ?>')");
                <?php else: ?>
                $(".jumbocontainer").css("background-image", "none");
                <?php endif; ?>
            });
        </script>
    </div>
</div>
<?php /* <pre><?php echo e(var_dump($stream)); ?></pre> */ ?>
