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
           url: "/ajax/stream/{{ $name }}"
       }).done(function(data){
           $("#stream-loading").hide();
           $(".jumbotron").append(data);
       }).fail(function(data){
           console.log(data);
           $(".jumbotron>.loading>.text").addClass("error").text("Error: "+data.responseJSON.error.message);
       });
       $.ajax({
           url: "/ajax/gallery"
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
<div class="container med-container">
    <div class="header">
        <nav>
            <ul class="nav nav-pills pull-right">
                <li role="presentation" class="active"><a href="#">Home</a></li>
                <li role="presentation"><a href="#">Get Featured</a></li>
                <li role="presentation" class="dropdown">
                    <a id="dLabel" data-target="#" href="/game" data-toggle="dropdown" aria-haspopup="true" role="button" aria-expanded="false">
                        Game
                        <span class="caret"></span>
                    </a>

                    <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="/game/tf2">Team Fortress 2</a></li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="/game/csgo">CSGO</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <a href="/" title="{{ Lang::get('main.title') }}" class="logo-title">{{ Lang::get('main.title') }}</a>
    </div>
</div>
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
    <div class="row gallery">
        <div class="loading" id="gallery-loading">
            <img src="/img/loading.gif" alt="loading">
            <span class="text">Loading Gallery...</span>
        </div>
    </div>
</div>

@include("layouts.footer")
@stop