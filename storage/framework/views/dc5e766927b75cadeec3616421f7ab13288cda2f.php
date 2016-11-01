<?php /* All Games */ ?>
<?php foreach($games->top as $game): ?>
<div class="col-sm-2 col-xs-4 game">
    <a href="/games/<?php echo e(rawurlencode($game->game->name)); ?>" title="<?php echo e($game->game->name); ?>">
        <img src="<?php echo e($game->game->box->large); ?>" alt="<?php echo e($game->game->name); ?>">
        <span class="title"><?php echo e($game->game->name); ?></span>
        <span class="viewers"><span class="glyphicon glyphicon-eye-open"></span><?php echo e($game->viewers); ?></span>
    </a>
</div>
<?php endforeach; ?>