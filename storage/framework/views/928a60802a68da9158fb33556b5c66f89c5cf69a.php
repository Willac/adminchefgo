<?php $__env->startSection('content'); ?>
    <div class="row">
        <table class="table table-striped table-bordered dt-responsive nowrap jambo_table" cellspacing="0"
               width="100%">
            <thead>
            <tr>
                <th>Rating</th>
                <th>Review</th>
                <th>Store</th>
                <th>User</th>
                <th>Created At</th>
                <th>Updated At</th>
            </tr>
            </thead>
            <tbody>
            <?php $__currentLoopData = $ratings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rating): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($rating->rating); ?></td>
                    <td><?php echo e($rating->review); ?></td>
                    <td><a href="<?php echo e(route('admin.stores.show', $rating->store->id)); ?>"><?php echo e($rating->store->name); ?></a></td>
                    <td><a href="<?php echo e(route('admin.users.show', $rating->user_id)); ?>"><?php echo e($rating->user->fullname()); ?></a></td>
                    <td><?php echo e($rating->created_at->diffForHumans()); ?></td>
                    <td><?php echo e($rating->updated_at->diffForHumans()); ?></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
        <div class="pull-right">
            <?php echo e($ratings->links()); ?>

        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>