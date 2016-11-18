@extends('layouts.wrapper')

@section('title')
<title>Page Not Found | TwitchRandom</title>
@stop

@section('meta')
<meta name="description" content="TwitchRandom.com - 404 Error Page: Page Not Found.">
@stop

@section('css')
<link rel="stylesheet" href="/css/main.min.css">
@stop

@section('content')
@include ("layouts.header")
<div class="jumbocontainer">
    <div class="container med-container stream-container">
        <div class="jumbotron missing-text">
            <h1>Page could not be found</h1>
            <a href="/" class="btn btn-lg btn-twitch">Return to the Home Page</a>
        </div>
    </div>
</div>
@include("layouts.footer")
@stop