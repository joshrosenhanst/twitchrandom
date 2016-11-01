<?php $__env->startSection('title'); ?>
    <title>ADmin | TwitchRandom</title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('meta'); ?>
    <meta name="description" content="We need slogans! Got any ideas? Find something unexpected at http://twitchrandom.com!">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php echo $__env->make("layouts.header", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <a href="slogans">Slogan Admin</a>
    <a href="features">Feature Admin</a>
    <?php echo $__env->make("layouts.footer", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.wrapper', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>