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
                <label for="slogan">New Slogan</label>
                <input type="text" class="form-control" id="slogan" name="slogan" placeholder="New Slogan">
                {{ csrf_field() }}
            </div>
            <button type="submit" class="btn btn-success">Submit Slogan</button>
        </form>
        <h4>Approved Slogans</h4>
        <p>These are the slogans that made the cut.</p>
        <ul class="list-group">
            @foreach($approved as $ap)
                <li class="list-group-item">{{ $ap->slogan }}</li>
            @endforeach
        </ul>
        {{--  <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#community" aria-controls="community" role="tab" data-toggle="tab">Community Submitted Slogans</a></li>
            <li role="presentation"><a href="#approved" aria-controls="approved" role="tab" data-toggle="tab">Approved Slogans</a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" role="tabpanel" id="community">
                <h4>Community Submitted Slogans</h4>
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
        </div> --}}
    </div>
@stop