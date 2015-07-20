@extends('layouts.wrapper')

@section('title')
    <title>Slogans | Twitch Random</title>
@stop

@section('meta')
    <meta name="description" content="We need slogans! Got any ideas? Find something unexpected at http://twitchrandom.com!">
@stop

@section('css')
@stop

@section('js')
    <script src="https://checkout.stripe.com/checkout.js"></script>
@stop


@section('content')
    @include("layouts.header")
    <div class="container">
        <h2>Slogans</h2>
        <h3>We need your best slogans!</h3>
        <p>You may have noticed that in the header we have a rotating slogan. Well, we're out of ideas and need your help! Submit your idea below and we might add it to the list of slogans.</p>
        <ul class="list-group">
        @foreach($slogans as $slogan)
            <li class="list-group-item">{{ $slogan->name }}</li>
        @endforeach
        </ul>
    </div>
@stop