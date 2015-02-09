{{-- HEADER --}}
<div class="container med-container">
    <div class="header">
        <nav>
            <ul class="nav nav-pills pull-right">
                <li role="presentation" class="active"><a href="#">Home</a></li>
                <li role="presentation"><a href="#">Get Featured</a></li>
                <li role="presentation" class="dropdown">
                    <a id="dLabel" data-target="#" href="/game" data-toggle="dropdown" aria-haspopup="true" role="button" aria-expanded="false">
                        Filter By Game
                        <span class="caret"></span>
                    </a>

                    <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="/game/Team Fortress 2">Team Fortress 2</a></li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="/game/Dota 2">Dota 2</a></li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="/game/Starbound">Starbound</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <a href="/" title="{{ Lang::get('main.title') }}" class="logo-title">{{ Lang::get('main.title') }}</a>
    </div>
</div>