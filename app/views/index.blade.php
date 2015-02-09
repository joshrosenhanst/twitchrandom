@extends('layouts.wrapper')

@section('title')
<title>Stream Randomizer</title>
@stop

@section('css')
<link rel="stylesheet" href="/css/main.css">
@stop

@section('js')
<script>
    @include("layouts.js.loading")
    $(document).ready(function(){
        $.ajax({
            url: "/ajax/beta/randomStream"
        }).done(function(data){
            $("#stream-loading").hide();
            $(".jumbotron").append(data);
        }).fail(function(data){
            console.log(data);
        });
        $.ajax({
            url: "/ajax/gallery"
        }).done(function(data){
            $("#gallery-loading").hide();
            $(".gallery").append(data);
        }).fail(function(data){
            console.log(data);
        });

        setInterval(function(){ $(".loading:visible>.text").setRandomText(); }, 1600);
    });
</script>
@stop

@section('content')
@include ("layouts.header")
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