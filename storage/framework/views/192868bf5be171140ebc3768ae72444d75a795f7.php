<?php $__env->startComponent('mail::message'); ?>

Hi <?php echo e($user->fullname()); ?>


You have successfully completed your registration. Welcome to <?php echo e(config('app.name')); ?>.

Thanks,

Team <?php echo e(config('app.name')); ?>

<?php echo $__env->renderComponent(); ?>