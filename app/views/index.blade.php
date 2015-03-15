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
    $(document).ready(function(){
        $.ajax({
            url: "/ajax/randomStream"
        }).done(function(data){
            $("#stream-loading").hide();
            $(".jumbotron").append(data).trigger("loadvideo");
        }).fail(function(data){
            console.log(data);
        });
        $.ajax({
            url: "/ajax/gallery"
        }).done(function(data){
            $("#gallery-loading").hide();
            $("#gallery-all").append(data);
        }).fail(function(data){
            console.log(data);
        });
        $.ajax({
            url: "/ajax/featured/3"
        }).done(function(data){
            $("#gallery-featured").append(data);
        }).fail(function(data){
            console.log(data);
        });

        $(".jumbotron").on("loadvideo", function(){
            //$(".main-stream").delay(6000).fadeIn(500);
            $(".main-stream").load(function(){
               $(this).css("visibility", "visible");
            });
        });

        $(".jumbocontainer").on("click", "#randomize-stream", function(e){
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
        });

        $("#gallery-reload").click(function(e){
            e.preventDefault();
            $("#gallery-all .gallery-item").remove();
            $("#gallery-loading").show();
            $.ajax({
                url: "/ajax/gallery"
            }).done(function(data){
                $("#gallery-loading").hide();
                $("#gallery-all").append(data);
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
            <div class="loading" id="stream-loading">
                <img src="/img/loading.gif" alt="loading">
                <span class="text">Loading Stream...</span>
            </div>
        </div>
    </div>
</div>
<div class="gallery-container">
    <div class="ad horizontal"></div>
    <div class="row">
        <div class="col-sm-9 with-ad">
            <div class="row gallery featured" id="gallery-featured">
                <div class="gallery-title">
                    <span class="title">Featured Streams</span>
                </div>
            </div>
            <div class="row gallery" id="gallery-all">
                <div class="gallery-title">
                    <span class="title">Random Streams</span>
                    <span class="btn pull-right gallery-reload" id="gallery-reload">
                        <span class="glyphicon glyphicon-refresh"></span>Load More
                    </span>
                </div>
                <div class="loading" id="gallery-loading">
                    <img src="/img/loading.gif" alt="loading">
                    <span class="text">Loading Gallery...</span>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="ad vertical"></div>
        </div>
    </div>
</div>

@include("layouts.footer")
@stop