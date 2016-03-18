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
    <script>
        $(document).ready(function(){
            var slogans = {!! json_encode($approved) !!};
            setInterval(function(){
                var new_slogan = slogans[Math.floor(Math.random() * slogans.length)]["slogan"];
                $(".slogan-logo .new_slogan").text(new_slogan);
            }, 2500)
        });
    </script>
@stop


@section('content')
    @include("layouts.header")
    <div class="marketingcontainer">
        <div class="container med-container">
            <h1>Slogans</h1>
            <h2 class="text-muted">We need your best slogans for Twitch Random!</h2>
            <p>For each page we randomly select a header slogan from our list of community provided slogans.</p>
            <p>You can help us out by submitting your idea for a new slogan below. If it's good we might use it on the site!</p>
            <div class="text-center">
                <div class="random-slogan-box">
                    <p class="slogan-logo">Twitch Random<span class="new_slogan">Find Something Unexpected</span></p>
                </div>
                <div class="slogan-subtitle">Some sample community slogans.</div>
            </div>

        </div>
    </div>
    <div class="container med-container">
        <form class="slogan-form" method="POST">
            <div class="form-group">
                <label for="slogan">Submit New Slogan <span>Keep it short and sweet!</span></label>
                <input type="text" class="form-control input-lg" id="slogan" name="slogan" placeholder="New Slogan">
                {{ csrf_field() }}
                @if(session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                @if(count($errors) > 0)
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-success btn-lg">Submit Slogan</button>
            </div>
        </form>
    </div>

    @include("layouts.footer")
@stop