<?php $__env->startSection('title'); ?>
    Menu Items &nbsp; <a class="btn btn-primary" href="<?php echo e(route('admin.menuitems.create')); ?>"><i class="fa fa-plus-circle"></i>
        Add</a>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="col-sm-12 pull-left">
        <div class="">
            <strong>Item Status: </strong>
            <a class="btn btn-warning" href="<?php echo e(app('request')->fullUrlWithQuery(['status' => 'pending'])); ?>">View Pending</a>
            <a class="btn btn-danger" href="<?php echo e(app('request')->fullUrlWithQuery(['status' => 'rejected'])); ?>">View Rejected</a>
            <a class="btn btn-success" href="<?php echo e(app('request')->fullUrlWithQuery(['status' => 'approved'])); ?>">View Approved</a>
        </div>
    </div>

    <div class="row">
        <table class="table table-striped table-bordered dt-responsive nowrap jambo_table" cellspacing="0"
               width="100%">
            <thead>
            <tr>
                <th>Title</th>
                <th>Store</th>
                <th>Price</th>
                <th>Is Non Veg?</th>
                <th>Status</th>
                <th>Updated At</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php $__currentLoopData = $menuitems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menuitem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr class="menuitem-row">
                    <td><?php echo e($menuitem->title); ?></td>
                    <td><a href="<?php echo e(route('admin.stores.show', [$menuitem->store_id])); ?>"><?php echo e($menuitem->store->name ? $menuitem->store->name : "NA"); ?></a></td>
                    <td><?php echo e($menuitem->price); ?></td>
                    <td><?php echo e($menuitem->is_non_veg); ?></td>
                    <td class="status"><?php echo e($menuitem->status); ?></td>
                    <td><?php echo e($menuitem->updated_at->diffForHumans()); ?></td>
                    <td>
                        <a class="btn btn-xs btn-primary" href="<?php echo e(route('admin.menuitems.show', [$menuitem->id])); ?>" data-toggle="tooltip" data-placement="top">
                            <i class="fa fa-eye"></i>
                        </a>
                        <a class="btn btn-xs btn-info" href="<?php echo e(route('admin.menuitems.edit', [$menuitem->id])); ?>" data-toggle="tooltip" data-placement="top">
                            <i class="fa fa-pencil"></i>
                        </a>
                        <?php if($menuitem->status === 'pending'): ?>
                            <?php echo e(Form::open(['route'=>['admin.menuitems.quickApprove', $menuitem->id],'method' => 'put','class'=>'form-horizontal form-label-left quick-approve'])); ?>

                                <button type="submit" class="btn btn-xs btn-primary" data-toggle="tooltip" data-placement="top">
                                    Quick Approve
                                </button>
                            <?php echo e(Form::close()); ?>

                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
        <div class="pull-right">
            <?php echo e($menuitems->links()); ?>

        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    ##parent-placeholder-16728d18790deb58b3b8c1df74f06e536b532695##
    <script type="text/javascript">
        $("form.quick-approve").submit(function (event) {
            event.preventDefault();
            var form = this;
            $.ajax({
                type: 'PUT',
                url: this.action,
                data: {},
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType: 'json'
            }).done(function (data) {
                $(form).closest(".menuitem-row").find(".status").text(data.status);
                $(form).hide();
            });
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>