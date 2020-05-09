<div class="top_nav">
    <div class="nav_menu">
        <nav>
            <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
            </div>

            <ul class="nav navbar-nav navbar-right">
                <li class="">
                    <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown"
                       aria-expanded="false">
                        <?php echo e(auth()->user()->fullname()); ?>

                        <span class=" fa fa-angle-down"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-usermenu pull-right">
                        <li>
                            <a href="<?php echo e(route('logout')); ?>">
                                <i class="fa fa-sign-out pull-right"></i> <?php echo e(__('views.backend.section.header.menu_0')); ?>

                            </a>
                        </li>
                    </ul>
                </li>
                <?php if(Auth::user()->hasRole('administrator')): ?>
                    <li role="presentation" class="dropdown" id="user-notifications">
                        <a href="javascript;;" class="dropdown-toggle info-number" data-toggle="dropdown"
                           aria-expanded="false" title="New Users Notifications" id="user-notifications-container">
                            <i class="fa fa-user-o"></i>
                            <span class="badge bg-green" id="user-notifications-count"><?php echo e(Auth::user()->unreadNotifications->where('type', 'App\Notifications\Admin\NewUser')->count()); ?></span>
                        </a>
                        <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                            <li>
                                <div class="text-center">
                                    <a id="delete-user-notifications">
                                        <strong>Clear All</strong>
                                    </a>
                                </div>
                            </li>
                            <?php $__currentLoopData = Auth::user()->notifications->where('type', 'App\Notifications\Admin\NewUser'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="user-notifications-row">
                                    <a href="<?php echo e(route('admin.users.show', ['user' => $notification->data['user_id']])); ?>">
                                    <span>
                                        <span>New <?php echo e(title_case($notification->data['role'])); ?> Registered</span>
                                        <span class="time"><?php echo e($notification->created_at->diffForHumans()); ?></span>
                                    </span>
                                    </a>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </li>

                    <li role="presentation" class="dropdown" id="order-notifications">
                        <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown"
                           aria-expanded="false" title="New Orders Notifications" id="order-notifications-container">
                            <i class="fa fa-shopping-cart"></i>
                            <span class="badge bg-green" id="order-notifications-count"><?php echo e(Auth::user()->unreadNotifications->where('type', 'App\Notifications\Admin\NewOrder')->count()); ?></span>
                        </a>
                        <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                            <li>
                                <div class="text-center">
                                    <a id="delete-order-notifications" href="#">
                                        <strong>Clear All</strong>
                                    </a>
                                </div>
                            </li>
                            <?php $__currentLoopData = Auth::user()->notifications->where('type', 'App\Notifications\Admin\NewOrder'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="order-notifications-row">
                                    <a href="<?php echo e(route('admin.orders.show', ['order' => $notification->data['order_id']])); ?>">
                                    <span>
                                        <span>New Order Placed</span>
                                        <span class="time"><?php echo e($notification->created_at->diffForHumans()); ?></span>
                                    </span>
                                    </a>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </li>
                <?php endif; ?>

            </ul>
        </nav>
    </div>
</div>