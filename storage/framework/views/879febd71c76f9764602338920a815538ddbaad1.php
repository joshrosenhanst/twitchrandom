<?php $__env->startSection('title'); ?>
<title><?php echo e($game); ?> | TwitchRandom</title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('meta'); ?>
<meta name="description" content="TwitchRandom.com - Random <?php echo e($game); ?> streams. Find something unexpected at https://twitchrandom.com!">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script>
    <?php echo $__env->make("layouts.js.loading", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    function loadGallery(galleryURL, galleryID){
        $.ajax({
            url: galleryURL
        }).done(function(data){
            $(galleryID+" .loading").hide();
            $(galleryID).append(data).show();
            $(galleryID+" .gallery-cont").niceScroll({cursorcolor:"#6441A5",cursoropacitymin:1,cursorwidth: "10px"})
            $(galleryID+" .gallery-reload").click(function(){
                $(galleryID+" .loading").show();
                $(galleryID+" .gallery-holder").remove();
                loadGallery(galleryURL, galleryID);
            });
        }).fail(function(data){
            console.log(data);
        });
    }

    $(document).ready(function(){
        //$("html").niceScroll({cursorcolor:"#6441A5"});
        $.ajax({
            url: "/ajax/game/<?php echo e(rawurlencode($game)); ?>/1"
        }).done(function(data){
            $(".jumbotron").append(data);
        }).fail(function(data){
            console.log(data);
            $(".jumbotron>.loading>.text").addClass("error").text("Error: "+data.responseJSON.error.message);
        });

        loadGallery("/ajax/game/<?php echo e(rawurlencode($game)); ?>/9", "#random-game-gallery");
        loadGallery("/ajax/top/<?php echo e(rawurlencode($game)); ?>", "#top-game-gallery");
        loadGallery("/ajax/featured/3", "#gallery-featured");

        $(".gallery-control-left").click(function(){
            if(!$(this).hasClass("disabled")){
                var gallery = $(this).siblings(".gallery-holder").find(".gallery-cont");
                var left = gallery.scrollLeft();
                var width = gallery.width() + 15;
                gallery.getNiceScroll(0).doScrollLeft(left - width,400);
            }
        });
        $(".gallery-control-right").click(function(){
            if(!$(this).hasClass("disabled")){
                var gallery = $(this).siblings(".gallery-holder").find(".gallery-cont");
                var left = gallery.scrollLeft();
                var width = gallery.width() + 15;
                gallery.getNiceScroll(0).doScrollLeft(left + width,400);
            }
        });

        $(".jumbocontainer").on("click", "#randomize-stream", function(e){
            e.preventDefault();
            $("#main-stream-container").remove();
            $.ajax({
                url: "/ajax/game/<?php echo e(rawurlencode($game)); ?>/1/true"
            }).done(function(data){
                $(".jumbotron").append(data);
            }).fail(function(data){
                console.log(data);
            });
        });

        //setInterval(function(){ $(".loading:visible>.text").setRandomText(); }, 1600);
    });
</script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<?php echo $__env->make("layouts.header", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<div class="jumbocontainer">
    <?php echo $__env->make("layouts.ads.horizontal", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <div class="container med-container stream-container">
        <div class="jumbotron">

        </div>
    </div>
</div>
<div class="gallery-container lg-container">
    <?php /*<div class="alert alert-info slogan-highlight"><span class="glyphicon glyphicon-certificate"></span> Got a good idea for a slogan? <a href="/slogans">Submit a new slogan for TwitchRandom!</a></div>*/ ?>
    <div class="row">
        <div class="gallery featured col-lg-9 col-md-12" id="gallery-featured">
            <div class="gallery-title">
                <span class="title">Featured Streams</span>
            </div>
            <div class="loading" id="featured-gallery-loading">
                <img src="/img/loading.gif" alt="loading">
                <span class="text">Loading Gallery...</span>
            </div>
        </div>
        <div class="col-lg-3 col-md-12 ad block">
            <?php echo $__env->make("layouts.ads.block", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </div>
    </div>
    <div class="row">
        <div class="gallery col-sm-12" id="random-game-gallery">
            <div class="gallery-title">
                <span class="title"><?php echo e($game); ?> | Random Streams</span>
            </div>
            <div class="gallery-control gallery-control-left"><span class="glyphicon glyphicon-chevron-left"></span></div>
            <div class="gallery-control gallery-control-right"><span class="glyphicon glyphicon-chevron-right"></span></div>
            <div class="loading" id="random-gallery-loading">
                <img src="/img/loading.gif" alt="loading">
                <span class="text">Loading Gallery...</span>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="gallery col-sm-12" id="top-game-gallery">
            <div class="gallery-title">
                <span class="title"><?php echo e($game); ?> | Top Streams</span>
            </div>
            <div class="gallery-control gallery-control-left"><span class="glyphicon glyphicon-chevron-left"></span></div>
            <div class="gallery-control gallery-control-right"><span class="glyphicon glyphicon-chevron-right"></span></div>
            <div class="loading" id="top-gallery-loading">
                <img src="/img/loading.gif" alt="loading">
                <span class="text">Loading Gallery...</span>
            </div>
        </div>
    </div>
</div>
<?php echo $__env->make("layouts.ads.horizontal2", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make("layouts.footer", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.wrapper', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>