<?php $__env->startSection('title', "Bank Details"); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <table class="table table-striped table-bordered dt-responsive nowrap jambo_table" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>Name</th>
                <th>User Id</th>
                <th>IFSC</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php $__currentLoopData = $bankDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bankDetail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($bankDetail->name); ?></td>
                    <td><?php echo e($bankDetail->user_id); ?></td>
                    <td><?php echo e($bankDetail->ifsc); ?></td>
                    <td><?php echo e($bankDetail->created_at); ?></td>
                    <td><?php echo e($bankDetail->updated_at); ?></td>
                    <td>
                        <a class="btn btn-xs btn-primary" href="<?php echo e(route('admin.bankdetails.show', [$bankDetail->id])); ?>" data-toggle="tooltip" data-placement="top">
                            <i class="fa fa-eye"></i>
                        </a>
                        <a class="btn btn-xs btn-info" href="<?php echo e(route('admin.bankdetails.edit', [$bankDetail->id])); ?>" data-toggle="tooltip" data-placement="top">
                            <i class="fa fa-pencil"></i>
                        </a>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
        <div class="pull-right">
            <?php echo e($bankDetails->links()); ?>

        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>