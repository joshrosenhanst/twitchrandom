@extends('layouts.wrapper')

@section('title')
    <title>Get Featured | Twitch Random</title>
@stop

@section('meta')
    <meta name="description" content="Get Featured on TwitchRandom.com. Find something unexpected at http://twitchrandom.com!">
@stop

@section('css')
@stop

@section('js')
    <script src="https://checkout.stripe.com/checkout.js"></script>
@stop


@section('content')
@include("layouts.header")
<div class="container narrow">
    <div class="jumbotron">
        <h1>Get Featured</h1>
        <p class="lead">You can have your stream prominently featured on every page of TwitchRandom.com. This can provide your stream with a whole new audience.</p>
        <p class="lead">Only 3 Streams can be featured per day, so be sure to register your stream now!</p>
        <p>
            <form action="charge.php" method="post">
                <script src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                        data-key="<?php echo $stripe['publishable_key']; ?>"
                        data-name="Twitch Random"
                        data-allow-remember-me="false"
                        data-label="Get Featured"
                        data-amount="5000" data-description="Get Featured"></script>
            </form>
        </p>
    </div>
    <div class="row">
        <div class="col-md-6">
            <h4>Get Featured for an Entire Day</h4>
            <p>When you select a day to be featured, your stream will be featured for the entire 24 hours.</p>
        </div>
        <div class="col-md-6">
            <h4>Select Multiple Days in Advance</h4>
            <p>You can have your stream featured for many days at a time. Selecting more than 1 day at a time also discounts the price per day.</p>
        </div>
    </div>
</div>
@stop