<?php $__env->startSection('content'); ?>
    <div class="row tile_count">
        <div class="col-md-4 col-sm-4 col-xs-4 tile_stats_count">
            <span class="count_top"><i class="fa fa-money"></i> Total Earnings</span>
            <div class="count green"><?php echo e($counts['total_earnings']); ?></div>
        </div>

        <div class="col-md-4 col-sm-4 col-xs-4 tile_stats_count">
            <span class="count_top"><i class="fa fa-money"></i> Total Earnings Paid</span>
            <div class="count green"><?php echo e($counts['paid_earnings']); ?></div>
        </div>

        <div class="col-md-4 col-sm-4 col-xs-4 tile_stats_count">
            <span class="count_top"><i class="fa fa-money"></i> Total Earnings Unpaid</span>
            <div class="count green"><?php echo e($counts['unpaid_earnings']); ?></div>
        </div>

    </div>


    <div class="col-md-12 col-sm-12 col-xs-12">
        <?php echo e(Form::open(['route'=>['admin.earnings'],'method' => 'get','class'=>'form-horizontal form-label-left'])); ?>


        <div class="form-group">
            <label class="control-label col-sm-2 col-xs-12">Paid Status: &nbsp;</label>
            <div class="col-sm-9 col-xs-12">
                <a class="btn btn-success" href="<?php echo e(app('request')->fullUrlWithQuery(['paid' => '1'])); ?>">Paid</a>
                <a class="btn btn-warning" href="<?php echo e(app('request')->fullUrlWithQuery(['paid' => '0'])); ?>">Unpaid</a>
                <a title="Clear" class="btn btn-default" href="<?php echo e(url_without_query_param('paid')); ?>"><i
                            class="fa fa-remove"></i></a>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-sm-2 col-xs-12">
                Date Filter:
            </label>
            <div class="col-sm-3 col-xs-12">
                <input id="from" type="date" class="form-control col-md-7 col-xs-12" placeholder="Date From"
                       name="from" value="<?php echo e(app('request')->input('from')); ?>">
            </div>
            <div class="col-sm-3 col-xs-12">
                <input id="to" type="date" class="form-control col-md-7 col-xs-12" placeholder="Date To"
                       name="to" value="<?php echo e(app('request')->input('to')); ?>">
            </div>
            <div class="col-sm-4 col-xs-12">
                <button type="submit" class="btn btn-success"><i class="fa fa-search"></i> Filter</button>
                <a title="Clear" class="btn btn-default" href="<?php echo e(url_without_query_param(['from', 'to'])); ?>"><i
                            class="fa fa-remove"></i></a>
            </div>
        </div>

        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="form-group">
                <label class="control-label col-sm-3 col-xs-12" for="search">
                    Search
                </label>
                <div class="col-sm-4 col-xs-12">
                    <input id="search" type="text" class="form-control col-md-7 col-xs-12"
                           placeholder="Search user's name, email, mobile"
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
        </div>
        <?php echo e(Form::close()); ?>

    </div>

    <div class="row">
        <table class="table table-striped table-bordered dt-responsive nowrap jambo_table" cellspacing="0"
               width="100%">
            <thead>
            <tr>
                <th>Order</th>
                <th>User</th>
                <th>Amount</th>
                <th>Paid</th>
                <th>Created At</th>
                <th>Updated At</th>
            </tr>
            </thead>
            <tbody>
            <?php $__currentLoopData = $earnings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $earning): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><a href="<?php echo e(route('admin.orders.show', $earning->order_id)); ?>"><?php echo e($earning->order_id); ?></a>
                    </td>
                    <td><a href="<?php echo e(route('admin.users.show', $earning->user_id)); ?>"><?php echo e($earning->user_id); ?></a></td>
                    <td><?php echo e($earning->amount); ?></td>
                    <td><?php echo e($earning->paid); ?></td>
                    <td><?php echo e($earning->created_at->diffForHumans()); ?></td>
                    <td><?php echo e($earning->updated_at->diffForHumans()); ?></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
        <div class="pull-right">
            <?php echo e($earnings->links()); ?>

        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>