@extends('layouts.wrapper')

@section('title')
<title>Stream Randomizer | Watch {{ $game }}</title>
@stop

@section('css')
<link rel="stylesheet" href="/css/main.css">
@stop

@section('js')
<script>
    @include("layouts.js.loading")
    $(document).ready(function(){
        $.ajax({
            url: "/ajax/game/{{{ $game }}}/1"
        }).done(function(data){
            $("#stream-loading").hide();
            $(".jumbotron").append(data);
        }).fail(function(data){
            console.log(data);
            $(".jumbotron>.loading>.text").addClass("error").text("Error: "+data.responseJSON.error.message);
        });
        $.ajax({
            url: "/ajax/game/{{{ $game }}}/9"
        }).done(function(data){
            $("#random-game-gallery-loading").hide();
            $("#random-game-gallery").append(data);
        }).fail(function(data){
            console.log(data);
        });
        $.ajax({
            url: "/ajax/top/{{{ $game }}}"
        }).done(function(data){
            $("#top-game-gallery-loading").hide();
            $("#top-game-gallery").append(data);
        }).fail(function(data){
            console.log(data);
        });

        $("#random-gallery-reload").click(function(e){
            e.preventDefault();
            $("#random-game-gallery .gallery-item").remove();
            $("#random-game-gallery-loading").show();
            $.ajax({
                url: "/ajax/game/{{{ $game }}}/9"
            }).done(function(data){
                $("#random-game-gallery-loading").hide();
                $("#random-game-gallery").append(data);
            }).fail(function(data){
                console.log(data);
            });
        });

        setInterval(function(){ $(".loading:visible>.text").not(".error").setRandomText(); }, 1600);
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
        <div class="ad horizontal"></div>
    </div>
</div>
<div class="container body-container">
    <div class="row gallery" id="random-game-gallery">
        <div class="gallery-title">
            <span class="title">{{{ $game }}} | Random Streams</span>
            <span class="btn pull-right gallery-reload" id="random-gallery-reload">
                <span class="glyphicon glyphicon-refresh"></span>Load More
            </span>
        </div>
        <div class="loading" id="random-game-gallery-loading">
            <img src="/img/loading.gif" alt="loading">
            <span class="text">Loading Gallery...</span>
        </div>
    </div>
    <div class="row gallery" id="top-game-gallery">
        <div class="gallery-title">
            <span class="title">{{{ $game }}} | Top Streams</span>
        </div>
        <div class="loading" id="top-game-gallery-loading">
            <img src="/img/loading.gif" alt="loading">
            <span class="text">Loading Gallery...</span>
        </div>
    </div>
</div>

@include("layouts.footer")
@stop