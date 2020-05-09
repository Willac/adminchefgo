<?php $__env->startSection('title'); ?>
    Coupons &nbsp; <a class="btn btn-primary" href="<?php echo e(route('admin.coupons.create')); ?>"><i class="fa fa-plus-circle"></i>
        Add</a>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">

        <table class="table table-striped table-bordered dt-responsive nowrap jambo_table" cellspacing="0"
               width="100%">
            <thead>
            <tr>
                <th>Code</th>
                <th>Reward</th>
                <th>Type</th>
                <th>Expires At</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php $__currentLoopData = $coupons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $coupon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr <?php if($coupon->isExpired()): ?> class="text-danger" <?php endif; ?>>
                    <td><?php echo e($coupon->code); ?></td>
                    <td><?php echo e($coupon->reward); ?></td>
                    <td><?php echo e($coupon->type); ?></td>
                    <td><?php echo e($coupon->expires_at->toDateString()); ?></td>
                    <td>
                        <a class="btn btn-xs btn-primary" data-toggle="tooltip" data-placement="top" href="<?php echo e(route('admin.coupons.edit', $coupon->id)); ?>">
                            <i class="fa fa-pencil"></i>
                        </a>
                        <?php echo e(Form::open(['route'=>['admin.coupons.destroy', $coupon->id],'method' => 'delete','class'=>'form-horizontal form-label-left'])); ?>

                        <button type="submit" title="Delete" class="btn btn-xs btn-danger" data-toggle="tooltip" data-placement="top">
                            <i class="fa fa-trash"></i>
                        </button>
                        <?php echo e(Form::close()); ?>

                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>