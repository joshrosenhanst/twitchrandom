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
@stop


@section('content')
    @include("layouts.header")
    <div class="container">
        <h2>Slogans</h2>
        <h3>We need your best slogans!</h3>
        <p>You may have noticed that in the header we have a rotating slogan. Well, we're out of ideas and need your help! Submit your idea below and we might add it to the list of slogans.</p>
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
        <form class="form-inline" method="POST">
            <div class="form-group">
                <label for="name">New Slogan</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="New Slogan">
                {{ csrf_field() }}
            </div>
            <button type="submit" class="btn btn-success">Submit Slogan</button>
        </form>
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#unapproved" aria-controls="unapproved" role="tab" data-toggle="tab">Unapproved Slogans</a></li>
            <li role="presentation"><a href="#approved" aria-controls="approved" role="tab" data-toggle="tab">Approved Slogans</a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" role="tabpanel" id="unapproved">
                <h4>Unapproved Slogans</h4>
                <p>We haven't checked these slogans yet. They're probably good, who knows?</p>
                <ul class="list-group">
                @foreach($unapproved as $un)
                        <li class="list-group-item">{{ $un->name }}</li>
                @endforeach
                </ul>
            </div>
            <div class="tab-pane" role="tabpanel" id="approved">
                <h4>Approved Slogans</h4>
                <p>These slogans are good enough! We're gonna use them.</p>
                <ul class="list-group">
                    @foreach($approved as $ap)
                        <li class="list-group-item">{{ $ap->name }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@stop