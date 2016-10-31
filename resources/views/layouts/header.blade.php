{{-- HEADER --}}
<nav class="navbar navbar-twitch navbar-static-top">
    <div class="container lg-container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed btn btn-twitch" data-toggle="collapse" data-target="#navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">TwitchRandom<span class="slogan">{{{ $random_text }}}</span></a>
        </div>

        <div class="collapse navbar-collapse" id="navbar">
            <ul class="nav navbar-nav navbar-right">
                <li role="presentation"><a href="/">Home</a></li>
                <li role="presentation" class="dropdown">
                    <a id="dLabel" data-target="#" href="/game" data-toggle="dropdown" aria-haspopup="true" role="button" aria-expanded="false">
                        Games
                        <span class="caret"></span>
                    </a>

                    <ul class="dropdown-menu dropdown-menu-right" role="menu" aria-labelledby="dLabel" id="top_games_dropdown">
                        @for($i=0;$i<10;$i++)
                            @if(isset($games_list[$i]))
                        <li role="presentation">
                            <a role="menuitem" tabindex="-1" href="/games/{{ rawurlencode($games_list[$i]['name']) }}">
                                <img src="{{ $games_list[$i]['img'] }}" alt="{{ htmlentities($games_list[$i]['name']) }}">
                                <span>{{ $games_list[$i]['name'] }}</span>
                            </a>
                        </li>
                            @endif
                        @endfor
                        <li class="divider"></li>
                        <li role="presentation" class="all_games"><a role="menuitem" tabindex="-1" href="/games">View All Games</a></li>
                    </ul>
                </li>
                <li role="presentation"><a href="/randomgame">Random Game</a></li>
                {{--<li role="presentation" class="active"><a href="/featured">Get Featured</a></li>--}}
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
{{--
<nav class="navbar navbar-static-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed btn btn-twitch" data-toggle="collapse" data-target="#navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/" title="{{ Lang::get('main.title') }}">{{ Lang::get('main.title') }}</a>
        </div>
        <div class="navbar-collapse collapse" id="navbar">
            <ul class="nav nav-pills navbar-right">
                <li role="presentation" class="active"><a href="/">Home</a></li>
                <li role="presentation" class="dropdown">
                    <a id="dLabel" data-target="#" href="/game" data-toggle="dropdown" aria-haspopup="true" role="button" aria-expanded="false">
                        Games
                        <span class="caret"></span>
                    </a>

                    <ul class="dropdown-menu dropdown-menu-right" role="menu" aria-labelledby="dLabel" id="top_games_dropdown">
                        @for($i=0;$i<10;$i++)
                        <li role="presentation">
                            <a role="menuitem" tabindex="-1" href="/games/{{{ rawurlencode($games_list[$i]['name']) }}}">
                                <img src="{{{ $games_list[$i]['img'] }}}">
                                <span>{{{ $games_list[$i]['name'] }}}</span>
                            </a>
                        </li>
                        @endfor
                        <li class="divider"></li>
                        <li role="presentation" class="all_games"><a role="menuitem" tabindex="-1" href="/games">View All Games</a></li>
                    </ul>
                </li>
                <li role="presentation"><a href="/randomgame" rel="nofollow">Random Game</a></li>
            </ul>
        </div>
    </div>
</nav>--}}