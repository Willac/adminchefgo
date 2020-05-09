<?php $__env->startSection('body_class','nav-md'); ?>

<?php $__env->startSection('page'); ?>
    <div class="container body">
        <div class="main_container">
            <?php $__env->startSection('header'); ?>
                <?php echo $__env->make('admin.sections.navigation', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <?php echo $__env->make('admin.sections.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php echo $__env->yieldSection(); ?>

            <?php echo $__env->yieldContent('left-sidebar'); ?>

            <div class="right_col" role="main">
                <div class="page-title">
                    <div class="title_left">
                        <h1 class="h3"><?php echo $__env->yieldContent('title'); ?></h1>
                    </div>
                    <?php if(Breadcrumbs::exists()): ?>
                        <div class="title_right">
                            <div class="pull-right">
                                <?php echo Breadcrumbs::render(); ?>

                            </div>
                        </div>
                    <?php endif; ?>
                </div>
                <?php echo $__env->yieldContent('content'); ?>
            </div>

            <footer>
                <?php echo $__env->make('admin.sections.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </footer>
            <audio id="notification-sound" src="<?php echo e(asset('assets/admin/notification.mp3')); ?>" preload="auto"></audio>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('styles'); ?>
    <?php echo e(Html::style(mix('assets/admin/css/admin.css'))); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <?php echo e(Html::script(mix('assets/admin/js/admin.js'))); ?>


    <script type="text/javascript">
        window.PUSHER_APP_KEY = "<?php echo e(env('PUSHER_APP_KEY')); ?>";
        window.PUSHER_APP_CLUSTER = "<?php echo e(env('PUSHER_APP_CLUSTER')); ?>";
        window.URL_NOTIFICATION_MARK_AS_READ = "<?php echo e(route('admin.json.notifications.read')); ?>";
        window.URL_NOTIFICATION_DELETE = "<?php echo e(route('admin.json.notifications.delete')); ?>";
        window.ADMIN_USER_ID = parseInt("<?php echo e(Auth::user()->hasRole('administrator') ? Auth::user()->id : 0); ?>");
        window.BROADCAST_AUTH_ENDPOINT = "<?php echo e(url('/') . '/broadcasting/auth'); ?>"
    </script>
    <?php echo e(Html::script(mix('assets/admin/js/init.js'))); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>