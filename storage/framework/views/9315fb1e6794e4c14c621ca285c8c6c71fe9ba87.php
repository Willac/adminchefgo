<?php $__env->startSection('title'); ?>
    Monedero electrónico &nbsp;
    <a class="btn btn-primary" href="<?php echo e(route('admin.emoneys.create')); ?>">
        <i class="fa fa-plus-circle"></i>
    Nuevo</a>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">

        <table class="table table-striped table-bordered dt-responsive nowrap jambo_table" cellspacing="0"
               width="100%">
            <thead>
            <tr>
                <th>Cliente</th>
                <th>Monto</th>
                <th>Voucher</th>
                <th>Activo</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody>
            <?php $__currentLoopData = $emoneys; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $emoney): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($emoney->user->fullname()); ?></td>
                    <td>$ <?php echo e($emoney->amount/100); ?></td>
                    <td><?php echo e($emoney->voucher); ?></td>
                    <td><?php if($emoney->active): ?>
                        <i class='fa fa-check'></i>
                        <?php else: ?>
                        <i class='fa fa-times'>
                        <?php endif; ?>
                    </td>
                    <td>
                        <a class="btn btn-xs btn-success" href="<?php echo e(route('admin.emoneys.edit', [$emoney->id])); ?>" data-toggle="tooltip" data-placement="top">
                            <i class="fa fa-pencil"></i>
                        </a>
                        <!-- <a class="btn btn-xs btn-primary" href="<?php echo e(route('admin.emoneys.show', [$emoney->id])); ?>" data-toggle="tooltip" data-placement="top">
                            <i class="fa fa-eye"></i>
                        </a>-->
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
        <div class="pull-right">
            <?php echo e($emoneys->links()); ?>

        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>