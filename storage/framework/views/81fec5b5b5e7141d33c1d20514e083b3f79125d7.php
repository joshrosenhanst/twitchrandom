<div class="gallery-holder">
    <div class="gallery-cont row">
        <?php foreach($galleries as $gallery): ?>
        <div class="gallery-item col-sm-4 col-md-3">
            <div class="item">
                <div class="item-image">
                    <a href="/stream/<?php echo e(rawurlencode($gallery->channel->name)); ?>" class="stream-image"><img src="<?php echo e($gallery->preview->medium); ?>" alt="Random Stream: <?php echo e(isset($gallery->channel->status) ? $gallery->channel->status : $gallery->channel->display_name); ?>" class="img-thumbnail"></a>
                    <a href="/games/<?php echo e($gallery->game); ?>" class="box-art"><img src="https://static-cdn.jtvnw.net/ttv-boxart/<?php echo e($gallery->game); ?>-40x55.jpg" alt="<?php echo e($gallery->game); ?> - Box Art"></a>
                </div>
                <a class="stream-link" href="/stream/<?php echo e(rawurlencode($gallery->channel->name)); ?>">
                    <h5 class="title"><?php echo e(isset($gallery->channel->status) ? $gallery->channel->status : $gallery->channel->display_name); ?></h5>
                    <p class="description"><span class="viewers"><span class="glyphicon glyphicon-eye-open"></span> <?php echo e($gallery->viewers); ?></span> on <?php echo e($gallery->channel->name); ?></p>
                </a>
            </div>
        </div>
        <?php endforeach; ?>
        <?php if($button): ?>
        <button class="gallery-reload btn btn-lg btn-twitch col-sm-4 col-md-3">
            Randomize Gallery
        </button>
        <?php endif; ?>
    </div>
</div>
<?php /* <pre><?php echo e(var_dump($galleries)); ?></pre> */ ?>