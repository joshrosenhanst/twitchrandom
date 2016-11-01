<?php $__env->startSection('title'); ?>
    <title>Slogan Admin | Twitch Random</title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('meta'); ?>
    <meta name="description" content="Slogan Admin. Find something unexpected at http://twitchrandom.com!">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
    <style>
        #approved .approve,#approved .destroy,#unapproved .unapprove{
            display:none;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script>
        $(document).ready(function(){
            $(".approved-list a.approve").click(function(event){
                event.preventDefault();
                var li = $(this).parents("li");
                var text = li.data("slogan-raw");
                var ul = li.parents(".approved-list");
                li.prependTo($("#approved .approved-list"));
                $("#slogan-alert .slogan-title").text(text);
                $("#slogan-alert .slogan-action").text("approved");
                approveSlogan(li.data("slogan-id"));
            });
            $(".approved-list a.unapprove").click(function(e){
                e.preventDefault();
                var li = $(this).parents("li");
                var text = li.data("slogan-raw");
                var ul = li.parents(".approved-list");
                li.prependTo($("#unapproved .approved-list"));
                $("#slogan-alert .slogan-title").text(text);
                $("#slogan-alert .slogan-action").text("rejected");
                unapproveSlogan(li.data("slogan-id"));
            });
            $(".approved-list a.destroy").click(function(e){
                e.preventDefault();
                var li = $(this).parents("li");
                var text = li.data("slogan-raw");
                var ul = li.parents(".approved-list");
                li.remove();
                $("#slogan-alert .slogan-title").text(text);
                $("#slogan-alert .slogan-action").text("destroyed");
                destroySlogan(li.data("slogan-id"));
            });
        });

        function approveSlogan(id){
            $.ajax({
                url: ("/admin/slogans/"+id+"/approve")
            })
            .done(function(data){
                updateCount();
            }).fail(function(data){
                console.log(data);
            });
        }
        function unapproveSlogan(id){
            $.ajax({
                url: ("/admin/slogans/"+id+"/reject")
            })
            .done(function(data){
                updateCount();
            }).fail(function(data){
                console.log(data);
            });
            updateCount();
        }

        function destroySlogan(id){
            $.ajax({
                url: ("/admin/slogans/"+id+"/destroy")
            })
            .done(function(data){
                updateCount();
            }).fail(function(data){
                console.log(data);
            });
            updateCount();
        }

        function updateCount(){
            var approvedCount = $("#approved .approved-list li").length;
            var unapprovedCount = $("#unapproved .approved-list li").length;
            $("#approvedCount").text("Approved ("+approvedCount+")");
            $("#unapprovedCount").text("Unapproved ("+unapprovedCount+")");
            $("#slogan-alert").show();
        }
    </script>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
    <?php echo $__env->make("layouts.header", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <div class="container">
        <h2>Slogan Admin</h2>
        <h3>Create new approved slogan</h3>
        <form class="slogan-form" method="POST">
            <div class="form-group">
                <label for="slogan">Submit New Approved Slogan</label>
                <input type="text" class="form-control input-lg" id="slogan" name="slogan" placeholder="<?php echo e($random_text); ?>" maxlength="50">
                <?php echo e(csrf_field()); ?>

                <?php if(session('status')): ?>
                    <div class="alert alert-success">
                        <?php echo e(session('status')); ?>

                    </div>
                <?php endif; ?>
                <?php if(count($errors) > 0): ?>
                    <div class="alert alert-danger">
                        <?php foreach($errors->all() as $error): ?>
                            <p><span class="glyphicon glyphicon-remove"></span> <?php echo e($error); ?></p>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
            <div class="form-group text-center">
                <button type="submit" class="btn btn-success btn-lg">Submit Slogan</button>
            </div>
        </form>
        <h3>Approve, unapprove or remove slogans.</h3>
        <div id="slogan-alert" class="alert alert-info">
            <strong><em class="slogan-title">SLOGAN TITLE</em></strong> has been <span class="slogan-action">ACTION</span>.
        </div>
        <?php if(session('status')): ?>
            <div class="alert alert-success">
                <?php echo e(session('status')); ?>

            </div>
        <?php endif; ?>
        <?php if(count($errors) > 0): ?>
            <div class="alert alert-danger">
                <?php foreach($errors->all() as $error): ?>
                    <p><?php echo e($error); ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a id="approvedCount" href="#approved" aria-controls="approved" role="tab" data-toggle="tab">Approved (<?php echo e(count($approved)); ?>)</a></li>
            <li role="presentation"><a href="#unapproved" id="unapprovedCount" aria-controls="unapproved" role="tab" data-toggle="tab">Unapproved (<?php echo e(count($unapproved)); ?>)</a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active panel panel-default" role="tabpanel" id="approved">
                <div class="panel-body">
                    <h4>Approved Slogans</h4>
                    <p>These slogans will appear under the Site Name on the header bar.</p>
                </div>
                <ul class="list-group approved-list">
                    <?php foreach($approved as $ap): ?>
                        <li class="list-group-item" data-slogan-id="<?php echo e($ap->id); ?>" data-slogan-raw="<?php echo e($ap->slogan); ?>">
                            <p><span class="slogan-text"><?php echo e($ap->slogan); ?></span>
                            <span class="pull-right">
                                    <a href="<?php echo e($ap->id); ?>/approve" title="Approve Slogan" class="btn btn-xs btn-success approve"><span class="glyphicon glyphicon-ok"></span></a>
                                    <a href="<?php echo e($ap->id); ?>/unapprove" title="Unpprove Slogan" class="btn btn-xs btn-danger unapprove"><span class="glyphicon glyphicon-remove"></span></a>
                                    <a href="<?php echo e($ap->id); ?>/destroy" title="Destroy Slogan" class="btn btn-xs btn-danger destroy"><span class="glyphicon glyphicon-trash"></span></a>
                                </span>
                            </p>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="tab-pane panel panel-default" role="tabpanel" id="unapproved">
                <div class="panel-body">
                    <h4>Unapproved Slogans</h4>
                    <p>These slogans can be approved or destroyed (removed from the database).</p>
                </div>
                <ul class="list-group approved-list">
                    <?php foreach($unapproved as $un): ?>
                        <li class="list-group-item" data-slogan-id="<?php echo e($un->id); ?>" data-slogan-raw="<?php echo e($un->slogan); ?>">
                            <p><span class="slogan-text"><?php echo e($un->slogan); ?></span>
                                <span class="pull-right">
                                    <a href="<?php echo e($un->id); ?>/approve" title="Approve Slogan" class="btn btn-xs btn-success approve"><span class="glyphicon glyphicon-ok"></span></a>
                                    <a href="<?php echo e($un->id); ?>/unapprove" title="Unpprove Slogan" class="btn btn-xs btn-danger unapprove"><span class="glyphicon glyphicon-remove"></span></a>
                                    <a href="<?php echo e($un->id); ?>/destroy" title="Destroy Slogan" class="btn btn-xs btn-danger destroy"><span class="glyphicon glyphicon-trash"></span></a>
                                </span>
                            </p>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
    <?php echo $__env->make("layouts.footer", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.wrapper', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>