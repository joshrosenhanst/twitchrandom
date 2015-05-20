@extends('layouts.wrapper')

@section('title')
<title>Twitch Random</title>
@stop

@section('css')
<link rel="stylesheet" href="/css/redesign/main.min.css">
@stop

@section('js')
<script>
    @include("layouts.js.loading")

    function loadGallery(galleryURL, galleryID){
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
        var manStateChange = true;
        var firstStream = "";
        var mainGame = "";
        History.Adapter.bind(window,'statechange',function(){ // Note: We are using statechange instead of popstate
            var State = History.getState(); // Note: We are using History.getState() instead of event.state
            if(manStateChange == true){
                //loadStream(State.title);
                if(State.title){
                    var ajaxurl = "/ajax/stream/"+State.title;
                }else{
                    var ajaxurl = "/ajax/stream/"+firstStream;
                }
                $("#main-stream-container").remove();
                $.ajax({
                    url: ajaxurl
                }).done(function(data){
                    $(".jumbotron").append(data);
                    var mainGame = $(".display-playing a").text();
                    $("#random-game-gallery .title").text(mainGame+" | Random Streams");
                    $("#random-game-gallery .gallery-holder").remove();
                    loadGallery("/ajax/game/"+rawurlencode(mainGame)+"/9", "#random-game-gallery");
                    //var historyurl = $("#main-stream-container .display-name").attr("href");
                }).fail(function(data){
                    console.log(data);
                });
            }
            manStateChange = true;
        });

        $("html").niceScroll({cursorcolor:"#6441A5"});
        $.ajax({
            url: "/ajax/randomStream"
        }).done(function(data){
            $(".jumbotron").append(data);
            var mainGame = $(".display-playing a").text();
            $("#random-game-gallery .title").text(mainGame+" | Random Streams");
            $("#random-game-gallery .gallery-holder").remove();
            loadGallery("/ajax/game/"+rawurlencode(mainGame)+"/9", "#random-game-gallery");
            firstStream = $("#main-stream-container .display-name").data("streamlink");
        }).fail(function(data){
            console.log(data);
        });

        loadGallery("/ajax/gallery", "#gallery-all");
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
            $("#stream-loading").show();
            $.ajax({
                url: "/ajax/randomStream"
            }).done(function(data){
                $(".jumbotron").append(data);
                var historyurl = $("#main-stream-container .display-name").data("streamlink");
                var mainGame = $(".display-playing a").text();
                $("#random-game-gallery .title").text(mainGame+" | Random Streams");
                $("#random-game-gallery .gallery-holder").remove();
                loadGallery("/ajax/game/"+rawurlencode(mainGame)+"/9", "#random-game-gallery");
                manStateChange = false;
                History.pushState({state:"/stream/"+historyurl},"Twitch Random | "+historyurl,"/stream/"+historyurl);
            }).fail(function(data){
                console.log(data);
            });
        });

        setInterval(function(){ $(".loading:visible>.text").setRandomText(); }, 1600);
    });
</script>
@stop

@section('content')
@include ("layouts.header")
<div class="jumbocontainer">
    @include("layouts.ads.horizontal2")
    <div class="container med-container stream-container">
        <div class="jumbotron">

        </div>
    </div>
</div>
<div class="gallery-container lg-container">
    <div class="row">
        <div class="gallery featured col-sm-9" id="gallery-featured">
            <div class="gallery-title">
                <span class="title">Featured Streams</span>
            </div>
            <div class="loading" id="featured-gallery-loading">
                <img src="/img/loading.gif" alt="loading">
                <span class="text">Loading Gallery...</span>
            </div>
        </div>
        <div class="col-sm-3 ad block">
            @include("layouts.ads.block")
        </div>
    </div>
    <div class="row">
        <div class="gallery col-sm-12" id="gallery-all">
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
    <div class="row">
        <div class="gallery col-sm-12" id="random-game-gallery">
            <div class="gallery-title">
                <span class="title">Game Streams</span>
            </div>
            <div class="gallery-control gallery-control-left"><span class="glyphicon glyphicon-chevron-left"></span></div>
            <div class="gallery-control gallery-control-right"><span class="glyphicon glyphicon-chevron-right"></span></div>
            <div class="loading" id="game-gallery-loading">
                <img src="/img/loading.gif" alt="loading">
                <span class="text">Loading Gallery...</span>
            </div>
        </div>
    </div>
</div>
@include("layouts.ads.horizontal2")
@include("layouts.footer")
@stop