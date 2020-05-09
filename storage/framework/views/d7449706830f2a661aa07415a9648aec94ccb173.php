<?php $__env->startSection('title'); ?>
    Categories &nbsp; <a class="btn btn-primary" href="<?php echo e(route('admin.categories.create')); ?>"><i class="fa fa-plus-circle"></i>
        Add</a>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">

        <table class="table table-striped table-bordered dt-responsive nowrap jambo_table" cellspacing="0"
               width="100%">
            <thead>
            <tr>
                <th>Title</th>
                <th>Image URL</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($category->title); ?></td>
                    <td><?php echo e($category->image_url); ?></td>
                    <td>
                        <a class="btn btn-xs btn-info" href="<?php echo e(route('admin.categories.edit', [$category->id])); ?>" data-toggle="tooltip" data-placement="top">
                            <i class="fa fa-pencil"></i>
                        </a>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
        <div class="pull-right">
            <?php echo e($categories->links()); ?>

        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>