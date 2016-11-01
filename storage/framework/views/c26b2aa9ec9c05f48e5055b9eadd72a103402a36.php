<?php /* HEADER */ ?>
<nav class="navbar navbar-twitch navbar-static-top">
    <div class="container lg-container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed btn btn-twitch" data-toggle="collapse" data-target="#navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">TwitchRandom<span class="slogan"><?php echo e($random_text); ?></span></a>
        </div>

        <div class="collapse navbar-collapse" id="navbar">
            <ul class="nav navbar-nav navbar-right">
                <li role="presentation"><a href="/">Home</a></li>
                <li role="presentation" class="dropdown">
                    <a id="dLabel" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" role="button" aria-expanded="false">
                        Games
                        <span class="caret"></span>
                    </a>

                    <ul class="dropdown-menu dropdown-menu-right" role="menu" aria-labelledby="dLabel" id="top_games_dropdown">
                        <?php for($i=0;$i<10;$i++): ?>
                            <?php if(isset($games_list[$i])): ?>
                        <li role="presentation">
                            <a role="menuitem" tabindex="-1" href="/games/<?php echo e(rawurlencode($games_list[$i]['name'])); ?>">
                                <img src="<?php echo e($games_list[$i]['img']); ?>" alt="<?php echo e(htmlentities($games_list[$i]['name'])); ?>">
                                <span><?php echo e($games_list[$i]['name']); ?></span>
                            </a>
                        </li>
                            <?php endif; ?>
                        <?php endfor; ?>
                        <li class="divider"></li>
                        <li role="presentation" class="all_games"><a role="menuitem" tabindex="-1" href="/games">View All Games</a></li>
                    </ul>
                </li>
                <li role="presentation"><a href="/randomgame">Random Game</a></li>
                <?php /*<li role="presentation" class="active"><a href="/featured">Get Featured</a></li>*/ ?>
            </ul>
        </div>
    </div>
</nav>