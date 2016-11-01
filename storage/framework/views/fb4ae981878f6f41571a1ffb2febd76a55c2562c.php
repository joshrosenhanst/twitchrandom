<div class="row">
<?php foreach($galleries as $gallery): ?>
<div class="gallery-item col-sm-4 col-xs-12">
    <div class="item">
        <div class="item-image">
            <a href="/stream/<?php echo e($gallery->stream->channel->name); ?>"><img src="<?php echo e($gallery->stream->preview->medium); ?>" alt="Random Stream: <?php echo e($gallery->stream->channel->status); ?>" class="img-thumbnail"></a>
            <a href="/games/<?php echo e($gallery->stream->game); ?>" class="box-art"><img src="https://static-cdn.jtvnw.net/ttv-boxart/<?php echo e($gallery->stream->game); ?>-40x55.jpg" alt="<?php echo e($gallery->stream->game); ?> - Box Art"></a>
        </div>
        <a class="stream-link" href="/stream/<?php echo e($gallery->stream->channel->name); ?>">
            <h5 class="title"><?php echo e(isset($gallery->stream->channel->status) ? $gallery->stream->channel->status : $gallery->stream->channel->display_name); ?></h5>
            <p class="description"><?php echo e($gallery->stream->viewers); ?> Viewers on <?php echo e($gallery->stream->channel->name); ?></p>
        </a>
    </div>
</div>
<?php endforeach; ?>
</div>
<?php /* <pre><?php echo e(var_dump($galleries)); ?></pre> */ ?>