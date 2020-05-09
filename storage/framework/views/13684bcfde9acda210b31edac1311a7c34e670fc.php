<?php $__env->startSection('title', "Stores"); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">

        <div class="col-md-12 col-sm-12 col-xs-12">
            <?php echo e(Form::open(['route'=>['admin.stores'],'method' => 'get','class'=>'form-horizontal form-label-left'])); ?>

            <div class="form-group">
                <label class="control-label col-sm-3 col-xs-12" for="search">
                    Search
                </label>
                <div class="col-sm-4 col-xs-12">
                    <input id="search" type="text" class="form-control col-md-7 col-xs-12"
                           placeholder="Search for name, tagline, address, area, details"
                           name="search" required value="<?php echo e(app('request')->input('search')); ?>">
                </div>
                <div class="col-sm-5 col-xs-12">
                    <button type="submit" class="btn btn-success"><i class="fa fa-search"></i> Filter</button>
                    <a title="Clear" class="btn btn-default" href="<?php echo e(url_without_query_param('search')); ?>"><i
                                class="fa fa-remove"></i></a>
                </div>
            </div>
            <div class="form-group">

            </div>
            <?php echo e(Form::close()); ?>

        </div>

        <table class="table table-striped table-bordered dt-responsive nowrap jambo_table" cellspacing="0"
               width="100%">
            <thead>
            <tr>
                <th>Name</th>
                <th>Address</th>
                <th>Owner</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php $__currentLoopData = $stores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $store): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($store->name); ?></td>
                    <td><?php echo e($store->address); ?></td>
                    <td><?php echo e($store->owner_id); ?></td>
                    <td><?php echo e($store->created_at); ?></td>
                    <td><?php echo e($store->updated_at); ?></td>
                    <td>
                        <a class="btn btn-xs btn-primary" href="<?php echo e(route('admin.stores.show', [$store->id])); ?>"
                           data-toggle="tooltip" data-placement="top">
                            <i class="fa fa-eye"></i>
                        </a>
                        <a class="btn btn-xs btn-info" href="<?php echo e(route('admin.stores.edit', [$store->id])); ?>"
                           data-toggle="tooltip" data-placement="top">
                            <i class="fa fa-pencil"></i>
                        </a>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
        <div class="pull-right">
            <?php echo e($stores->links()); ?>

        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>