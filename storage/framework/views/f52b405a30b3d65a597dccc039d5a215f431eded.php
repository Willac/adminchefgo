<?php $__env->startSection('title'); ?>
    Tarjetas &nbsp; <a class="btn btn-primary" href="<?php echo e(route('admin.cards.create')); ?>"><i class="fa fa-plus-circle"></i>
        Nuevo</a>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">

        <table class="table table-striped table-bordered dt-responsive nowrap jambo_table" cellspacing="0"
               width="100%">
            <thead>
            <tr>
                <th>Nombre</th>
                <th>Cuenta</th>
                <th>Cliente</th>
            </tr>
            </thead>
            <tbody>
            <?php $__currentLoopData = $cards; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $card): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($card->name); ?></td>
                    <td><?php echo e($card->account_number); ?></td>
                    <td><?php echo e($card->user->fullname()); ?></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
        <div class="pull-right">
            <?php echo e($cards->links()); ?>

        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>