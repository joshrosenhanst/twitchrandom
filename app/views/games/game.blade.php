@extends('layouts.wrapper')

@section('title')
<title>Stream Randomizer | Watch</title>
@stop

@section('css')
<link rel="stylesheet" href="/css/main.css">
@stop

@section('js')
<script>
    @include("layouts.js.loading")
    $(document).ready(function(){
        $.ajax({
            url: "/ajax/game/{{ $game }}/1"
        }).done(function(data){
            $("#stream-loading").hide();
            $(".jumbotron").append(data);
        }).fail(function(data){
            console.log(data);
            $(".jumbotron>.loading>.text").addClass("error").text("Error: "+data.responseJSON.error.message);
        });
        $.ajax({
            url: "/ajax/game/{{ $game }}/9"
        }).done(function(data){
            $("#gallery-loading").hide();
            $(".gallery").append(data);
        }).fail(function(data){
            console.log(data);
        });

        setInterval(function(){ $(".loading:visible>.text").not(".error").setRandomText(); }, 1600);
    });
</script>
@stop

@section('content')

@include("layouts.header")
<div class="jumbocontainer">
    <div class="container med-container stream-container">
        <div class="ad horizontal"></div>
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
    <div role ="tabpanel">
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#random/{{ $game }}" aria-controls="random_game" role="tab" data-toggle="tab">{{ $game }} Random Streams</a></li>
            <li role="presentation"><a href="#top/{{ $game }}" aria-controls="top_game" role="tab" data-toggle="tab">{{ $game }} Top Streams</a></li>
            <li role="presentation"><a href="#random/all" aria-controls="random_all" role="tab" data-toggle="tab">Any Random Streams</a></li>
            <li role="presentation"><a href="#featured/all" aria-controls="featured_all" role="tab" data-toggle="tab">Any Featured Streams</a></li>
        </ul>
    </div>
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane fade active" id="random/{{ $game }}">
            <div class="row gallery">
                <div class="loading" id="random-game-gallery-loading">
                    <img src="/img/loading.gif" alt="loading">
                    <span class="text">Loading Gallery...</span>
                </div>
            </div>
        </div>
        <div role="tabpanel" class="tab-pane fade" id="top/{{ $game }}">
            <div class="row gallery">
                <div class="loading" id="top-game-gallery-loading">
                    <img src="/img/loading.gif" alt="loading">
                    <span class="text">Loading Gallery...</span>
                </div>
            </div>
        </div>
        <div role="tabpanel" class="tab-pane fade" id="random/all">
            <div class="row gallery">
                <div class="loading" id="gallery-loading">
                    <img src="/img/loading.gif" alt="loading">
                    <span class="text">Loading Gallery...</span>
                </div>
            </div>
        </div>
        <div role="tabpanel" class="tab-pane fade" id="featured/all">
            <div class="row gallery">
                <div class="loading" id="featured-gallery-loading">
                    <img src="/img/loading.gif" alt="loading">
                    <span class="text">Loading Gallery...</span>
                </div>
            </div>
        </div>
    </div>
</div>

@include("layouts.footer")
@stop