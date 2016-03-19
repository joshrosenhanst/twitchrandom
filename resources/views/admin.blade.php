@extends('layouts.wrapper')

@section('title')
    <title>ADmin | TwitchRandom</title>
@stop

@section('meta')
    <meta name="description" content="We need slogans! Got any ideas? Find something unexpected at http://twitchrandom.com!">
@stop

@section('css')
@stop

@section('js')
@stop

@section('content')
    @include("layouts.header")
    <a href="slogans">Slogan Admin</a>
    <a href="features">Feature Admin</a>
    @include("layouts.footer")
@stop