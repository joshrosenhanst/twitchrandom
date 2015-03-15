@extends('layouts.wrapper')

@section('title')
<title>Twitch Randomizer | Watch</title>
@stop

@section('css')
<link rel="stylesheet" href="/css/redesign/main.min.css">
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
           $("#gallery-all").append(data);
       }).fail(function(data){
           console.log(data);
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

@include("layouts.footer")
@stop