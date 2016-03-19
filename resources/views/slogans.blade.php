@extends('layouts.wrapper')

@section('title')
    <title>Slogans | TwitchRandom</title>
@stop

@section('meta')
    <meta name="description" content="We need slogans! Got any ideas? Find something unexpected at http://twitchrandom.com!">
@stop

@section('css')
@stop

@section('js')
    <script>
        $(document).ready(function(){
            var slogans = {!! $approved !!};
            setInterval(function(){
                var new_slogan = slogans[Math.floor(Math.random() * slogans.length)]["slogan"];
                $(".slogan-logo .new_slogan").text(new_slogan);
                twemoji.parse($(".slogan-logo .new_slogan")[0], {
                    folder: 'svg',
                    ext: '.svg',
                    callback: function(icon, options, variant) {
                        switch ( icon ) {
                            case 'a9':      // © copyright
                            case 'ae':      // ® registered trademark
                            case '2122':    // ™ trademark
                                return false;
                        }
                        return ''.concat(options.base, options.size, '/', icon, options.ext);
                    }
                });
            }, 2500);
        });
    </script>
@stop


@section('content')
    @include("layouts.header")
    <div class="marketingcontainer">
        <div class="container med-container">
            <h1>Slogans</h1>
            <h2 class="text-muted">We need your best slogans for TwitchRandom!</h2>
            <p>For each page we randomly select a header slogan from our list of community provided slogans.</p>
            <p>You can help us out by submitting your idea for a new slogan below. If it's good we might use it on the site!</p>
            <div class="text-center">
                <div class="random-slogan-box">
                    <p class="slogan-logo">TwitchRandom<span class="new_slogan">Find Something Unexpected</span></p>
                </div>
                <div class="slogan-subtitle">Some sample community slogans.</div>
            </div>

        </div>
    </div>
    <div class="container med-container">
        <form class="slogan-form" method="POST">
            <div class="form-group">
                <label for="slogan">Submit New Slogan <span>Keep it short and sweet!</span></label>
                <input type="text" class="form-control input-lg" id="slogan" name="slogan" placeholder="{{ $random_text }}" maxlength="50" required>
                {{ csrf_field() }}
                @if(count($errors) > 0)
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <p><span class="glyphicon glyphicon-remove"></span> {{ $error }}</p>
                        @endforeach
                    </div>
                @endif
            </div>
            <div class="form-group text-center">
                <button type="submit" class="btn btn-success btn-lg">Submit Slogan</button>
            </div>
        </form>
    </div>

    @include("layouts.footer")
@stop