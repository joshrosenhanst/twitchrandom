@extends('layouts.wrapper')

@section('title')
<title>Twitch Randomizer</title>
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
            firstStream = $("#main-stream-container .display-name").data("streamlink");
        }).fail(function(data){
            console.log(data);
        });

        window.onPlayerEvent = function (data) {
            data.forEach(function(event) {
                if (event.event == "videoPlaying") {
                    $(".jumbocontainer").trigger("loadvideo");
                }
            });
        };

        loadGallery("/ajax/gallery", "#gallery-all");
        loadGallery("/ajax/featured/3", "#gallery-featured");

        $(".jumbocontainer").on("loadvideo", function(){
            $("#main-stream").removeClass("outside");
            $("#inside-stream-loading").hide();
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

        $(".jumbocontainer").on("click", "#randomize-stream", function(e){
            e.preventDefault();
            $("#main-stream-container").remove();
            $("#stream-loading").show();
            $.ajax({
                url: "/ajax/randomStream"
            }).done(function(data){
                $(".jumbotron").append(data);
                var historyurl = $("#main-stream-container .display-name").data("streamlink");
                manStateChange = false;
                History.pushState({state:"/stream/"+historyurl},historyurl,"/stream/"+historyurl);
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

    <div class="container med-container stream-container">
        <div class="jumbotron">

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