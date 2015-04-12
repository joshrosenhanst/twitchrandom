@extends('layouts.wrapper')

@section('title')
<title>Twitch Randomizer | Watch</title>
@stop

@section('css')
<link rel="stylesheet" href="/css/redesign/main.min.css">
@stop

@section('js')
<script src="/js/nicescroll.min.js"></script>
<script>
    @include("layouts.js.loading")function loadGallery(galleryURL, galleryID){
        $.ajax({
            url: galleryURL
        }).done(function(data){
            $(galleryID+" .loading").hide();
            $(galleryID).append(data);
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
        $("html").niceScroll({cursorcolor:"#6441A5"});
        $.ajax({
            url: "/ajax/stream/{{{ rawurlencode($name) }}}"
        }).done(function(data){
            $("#stream-loading").hide();
            $(".jumbotron").append(data).trigger("loadvideo");
        }).fail(function(data){
            console.log(data);
            $(".jumbotron>.loading>.text").addClass("error").text("Error: "+data.responseJSON.error.message);
        });
        loadGallery("/ajax/gallery", "#gallery-all");
        loadGallery("/ajax/featured/3", "#gallery-featured");

        $(".jumbotron").on("loadvideo", function(){
            $(".main-stream").load(function(){
                $(this).css("visibility", "visible");
            });
        });

        $(".gallery-control-left").click(function(){
            if(!$(this).hasClass("disabled")){
                var gallery = $(this).siblings(".gallery-holder").find(".gallery-cont");
                var left = gallery.scrollLeft();
                gallery.getNiceScroll(0).doScrollLeft(left - 650,400);
            }
        });
        $(".gallery-control-right").click(function(){
            if(!$(this).hasClass("disabled")){
                var gallery = $(this).siblings(".gallery-holder").find(".gallery-cont");
                var left = gallery.scrollLeft();
                gallery.getNiceScroll(0).doScrollLeft(left + 650,400);
            }
        });

        /*$(".jumbocontainer").on("click", "#randomize-stream", function(e){
            e.preventDefault();
            $("#main-stream-container").remove();
            $("#stream-loading").show();
            $.ajax({
                url: "/ajax/randomStream"
            }).done(function(data){
                $("#stream-loading").hide();
                $(".jumbotron").append(data).trigger("loadvideo");
            }).fail(function(data){
                console.log(data);
            });
        });*/

        setInterval(function(){ $(".loading:visible>.text").setRandomText(); }, 1600);
    });
</script>
@stop

@section('content')
@include("layouts.header")
<div class="jumbocontainer">
    <div class="container med-container stream-container">
        <div class="jumbotron">
            <div class="loading" id="stream-loading">
                <img src="/img/loading.gif" alt="loading">
                <span class="text">Loading Stream...</span>
            </div>
        </div>
    </div>
</div>
<div class="gallery-container lg-container">
    <div class="ad horizontal"></div>
    <div class="row">
        <div class="col-sm-10 with-ad">
            <div class="gallery featured" id="gallery-featured">
                <div class="gallery-title">
                    <span class="title">Featured Streams</span>
                </div>
                <div class="loading" id="featured-gallery-loading">
                    <img src="/img/loading.gif" alt="loading">
                    <span class="text">Loading Gallery...</span>
                </div>
            </div>
            <div class="gallery" id="gallery-all">
                <div class="gallery-title">
                    <span class="title">Random Streams</span>
                </div>
                <div class="gallery-control gallery-control-left"><span class="glyphicon glyphicon-chevron-left"></span></div>
                <div class="gallery-control gallery-control-right"><span class="glyphicon glyphicon-chevron-right"></span></div>
                <div class="loading" id="gallery-loading">
                    <img src="/img/loading.gif" alt="loading">
                    <span class="text">Loading Gallery...</span>
                </div>
            </div>
        </div>
        <div class="col-sm-2">
            <div class="ad vertical"></div>
        </div>
    </div>
</div>

@include("layouts.footer")
@stop