{{-- HEADER --}}
<div class="container med-container">
    <div class="header">
        <nav>
            <ul class="nav nav-pills pull-right">
                <li role="presentation" class="active"><a href="/">Home</a></li>
                <li role="presentation"><a href="/feature">Get Featured</a></li>
                <li role="presentation" class="dropdown">
                    <a id="dLabel" data-target="#" href="/game" data-toggle="dropdown" aria-haspopup="true" role="button" aria-expanded="false">
                        Top Games
                        <span class="caret"></span>
                    </a>

                    <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel" id="top_games_dropdown">
                        {{--<li role="presentation"><a role="menuitem" tabindex="-1" href="/game/Team Fortress 2">Team Fortress 2</a></li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="/game/Dota 2">Dota 2</a></li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="/game/Starbound">Starbound</a></li>--}}
                        @for($i=0;$i<10;$i++)
                        <li role="presentation">
                            <a role="menuitem" tabindex="-1" href="/game/{{{ rawurlencode($games_list[$i]['name']) }}}">
                                <img src="{{{ $games_list[$i]['img'] }}}">
                                <span>{{{ $games_list[$i]['name'] }}}</span>
                            </a>
                        </li>
                        @endfor
                        <li class="divider"></li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="/randomgame">Random Game</a></li>
                    </ul>
                </li>
                <li role="presentation"><a href="/randomgame">Random Game</a></li>
            </ul>
        </nav>
        <a href="/" title="{{ Lang::get('main.title') }}" class="logo-title">{{ Lang::get('main.title') }}</a>
    </div>
</div>