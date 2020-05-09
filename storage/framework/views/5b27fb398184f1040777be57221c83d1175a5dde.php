<?php $__env->startSection('title'); ?>
    Users &nbsp; <a class="btn btn-primary" href="<?php echo e(route('admin.users.create')); ?>"><i class="fa fa-plus-circle"></i>
        Add</a>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12" style="margin-bottom: 20px">
            <?php echo e(Form::open(['route'=>['admin.users'],'method' => 'get','class'=>'form-horizontal form-label-left'])); ?>

            <div class="form-group">
                <label class="control-label col-sm-3 col-xs-12" for="search">
                    Search
                </label>
                <div class="col-sm-4 col-xs-12">
                    <input id="search" type="text" class="form-control col-md-7 col-xs-12"
                           placeholder="Search for name, mobile, email"
                           name="search" required value="<?php echo e(app('request')->input('search')); ?>">
                </div>
                <div class="col-sm-5 col-xs-12">
                    <button type="submit" class="btn btn-success"><i class="fa fa-search"></i> Filter</button>
                    <a title="Clear" class="btn btn-default" href="<?php echo e(url_without_query_param('search')); ?>"><i
                                class="fa fa-remove"></i></a>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-3 col-xs-12">
                    Role
                </label>
                <div class="col-sm-9 col-xs-12">
                    <a class="btn btn-primary <?php if(request('role') == 'owner'): ?> active <?php endif; ?>"
                       href="<?php echo e(app('request')->fullUrlWithQuery(['role' => 'owner'])); ?>"><i class="fa fa-cutlery"></i>
                        Store</a>
                    <a class="btn btn-info <?php if(request('role') == 'delivery'): ?> active <?php endif; ?>"
                       href="<?php echo e(app('request')->fullUrlWithQuery(['role' => 'delivery'])); ?>"><i
                                class="fa fa-motorcycle"></i> Delivery</a>
                    <a class="btn btn-success <?php if(request('role') == 'customer'): ?> active <?php endif; ?>"
                       href="<?php echo e(app('request')->fullUrlWithQuery(['role' => 'customer'])); ?>"><i class="fa fa-user-o"></i>
                        User</a>
                    <a title="Clear" class="btn btn-default" href="<?php echo e(url_without_query_param('role')); ?>"><i
                                class="fa fa-remove"></i></a>
                </div>
            </div>
            <?php echo e(Form::close()); ?>

        </div>

        <table class="table table-striped table-bordered dt-responsive nowrap jambo_table" cellspacing="0"
               width="100%" style="text-align: center">
            <thead>
            <tr>
                <th><?php echo \Kyslik\ColumnSortable\SortableLink::render(array ('email', __('views.admin.users.index.table_header_0'),['page' =>
                    $users->currentPage()]));?>
                </th>
                <th>Mobile</th>
                <th><?php echo \Kyslik\ColumnSortable\SortableLink::render(array ('name', 'Name',['page' => $users->currentPage()]));?></th>
                <th><?php echo e(__('views.admin.users.index.table_header_2')); ?></th>
                <th>Mobile Verified</th>
                <th>Quick Links</th>
                
                
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($user->email); ?></td>
                    <td><?php echo e($user->mobile_number); ?></td>
                    <td><?php echo e($user->fullname()); ?></td>
                    <td>
                        <h4>
                            
                            <?php if($user->hasRole('administrator')): ?>
                                <i class="fa fa-lock" title="Administrator"></i>
                            <?php endif; ?>
                            <?php if($user->hasRole('owner')): ?>
                                <i class="fa fa-cutlery" title="Store"></i>
                            <?php endif; ?>
                            <?php if($user->hasRole('delivery')): ?>
                                <i class="fa fa-motorcycle" title="Delivery Executive"></i>
                            <?php endif; ?>
                            <?php if($user->hasRole('customer')): ?>
                                <i class="fa fa-user-o" title="Customer"></i>
                            <?php endif; ?>
                        </h4>
                    </td>
                    <td>
                        <?php if($user->mobile_verified): ?>
                            <span class="label label-primary"><i class="fa fa-check"></i></span>
                        <?php else: ?>
                            <span class="label label-danger"><i class="fa fa-times"></i></span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if($user->hasRole('owner') && $user->store): ?>
                            <a href="<?php echo e(route('admin.orders', ["store" => $user->store->id])); ?>">Orders</a> |
                            <a href="<?php echo e(route('admin.earnings', ["user_id" => $user->id])); ?>">Earnings</a> |
                            <a href="<?php echo e(route('admin.bankdetails', ["user" => $user->id])); ?>">Bank Details</a>
                            <br/>
                            <a href="<?php echo e(route('admin.stores', ["store" => $user->store->id])); ?>">Store</a> |
                            <a href="<?php echo e(route('admin.menuitems', ["store" => $user->store->id])); ?>">Menu Items</a> |
                            <a href="<?php echo e(route('admin.ratings', ["store" => $user->store->id])); ?>">Ratings</a>
                        <?php endif; ?>
                            <?php if($user->hasRole('delivery') && $user->deliveryProfile): ?>
                                <a href="<?php echo e(route('admin.orders', ["delivery_profile_id" => $user->deliveryProfile->id])); ?>">Orders</a> |
                                <a href="<?php echo e(route('admin.delivery_profiles', ["delivery_profile_id" => $user->deliveryProfile->id])); ?>">Delivery Profile</a> |
                                <a href="<?php echo e(route('admin.earnings', ["user_id" => $user->id])); ?>">Earnings</a> |
                            <?php endif; ?>
                        <?php if($user->hasRole('customer')): ?>
                            <a href="<?php echo e(route('admin.orders', ["user" => $user->id])); ?>">Orders</a>
                        <?php endif; ?>
                    </td>
                    
                    
                    
                    
                    
                    
                    <td>
                        <a class="btn btn-xs btn-primary" href="<?php echo e(route('admin.users.show', [$user->id])); ?>"
                           data-toggle="tooltip" data-placement="top"
                           data-title="<?php echo e(__('views.admin.users.index.show')); ?>">
                            <i class="fa fa-eye"></i>
                        </a>
                        <a class="btn btn-xs btn-info" href="<?php echo e(route('admin.users.edit', [$user->id])); ?>"
                           data-toggle="tooltip" data-placement="top"
                           data-title="<?php echo e(__('views.admin.users.index.edit')); ?>">
                            <i class="fa fa-pencil"></i>
                        </a>
                        <?php if(!$user->hasRole('administrator')): ?>
                        <a class="btn btn-xs btn-danger user_destroy delete" href="<?php echo e(route('admin.users.destroy', [$user->id])); ?>"
                           data-toggle="tooltip" data-placement="top" data-title="<?php echo e(__('views.admin.users.index.delete')); ?>">
                        <i class="fa fa-trash"></i>
                        </a>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
        <div class="pull-right">
            <?php echo e($users->links()); ?>

        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>