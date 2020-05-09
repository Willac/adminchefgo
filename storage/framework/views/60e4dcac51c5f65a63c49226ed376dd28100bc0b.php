<?php $__env->startSection('title', 'Add User' ); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <?php echo e(Form::open(['route'=>['admin.users.store'],'method' => 'post','class'=>'form-horizontal form-label-left'])); ?>


            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">
                    Name
                    <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input id="name" type="text"
                           class="form-control col-md-7 col-xs-12 <?php if($errors->has('name')): ?> parsley-error <?php endif; ?>"
                           name="name" required>
                    <?php if($errors->has('name')): ?>
                        <ul class="parsley-errors-list filled">
                            <?php $__currentLoopData = $errors->get('name'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="parsley-required"><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </div>
            
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last_name">
                    <?php echo e(__('views.admin.users.edit.last_name')); ?>

                    <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input id="last_name" type="text"
                           class="form-control col-md-7 col-xs-12 <?php if($errors->has('last_name')): ?> parsley-error <?php endif; ?>"
                           name="last_name" required>
                    <?php if($errors->has('last_name')): ?>
                        <ul class="parsley-errors-list filled">
                            <?php $__currentLoopData = $errors->get('last_name'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="parsley-required"><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">
                    Email
                    <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input id="email" type="email"
                           class="form-control col-md-7 col-xs-12 <?php if($errors->has('email')): ?> parsley-error <?php endif; ?>"
                           name="email" required>
                    <?php if($errors->has('email')): ?>
                        <ul class="parsley-errors-list filled">
                            <?php $__currentLoopData = $errors->get('email'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="parsley-required"><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="mobile_number">
                    Mobile
                    <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input id="mobile_number" type="text"
                           class="form-control col-md-7 col-xs-12 <?php if($errors->has('mobile_number')): ?> parsley-error <?php endif; ?>"
                           name="mobile_number" required>
                    <?php if($errors->has('mobile_number')): ?>
                        <ul class="parsley-errors-list filled">
                            <?php $__currentLoopData = $errors->get('mobile_number'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="parsley-required"><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="mobile_verified">
                    Mobile Verified 
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="checkbox">
                        <label>
                            <input id="mobile_verified" type="checkbox" class="<?php if($errors->has('mobile_verified')): ?> parsley-error <?php endif; ?>"
                                   name="mobile_verified" value="1" checked="true"  readonly="readonly" style="display: none;">
                            <?php if($errors->has('mobile_verified')): ?>
                                <ul class="parsley-errors-list filled">
                                    <?php $__currentLoopData = $errors->get('mobile_verified'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li class="parsley-required"><?php echo e($error); ?></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            <?php endif; ?>
                        </label>
                    </div>
                </div>
            </div>

            

            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            

            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="password">
                    Password
                    <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input id="password" type="password"
                           class="form-control col-md-7 col-xs-12 <?php if($errors->has('password')): ?> parsley-error <?php endif; ?>"
                           name="password" required>
                    <?php if($errors->has('password')): ?>
                        <ul class="parsley-errors-list filled">
                            <?php $__currentLoopData = $errors->get('password'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="parsley-required"><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="password_confirmation">
                    Confirm Password
                    <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input id="password_confirmation" type="password"
                           class="form-control col-md-7 col-xs-12 <?php if($errors->has('password_confirmation')): ?> parsley-error <?php endif; ?>"
                           name="password_confirmation" required>
                    <?php if($errors->has('password_confirmation')): ?>
                        <ul class="parsley-errors-list filled">
                            <?php $__currentLoopData = $errors->get('password_confirmation'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="parsley-required"><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="roles">
                    Roles
                    <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <select id="roles" name="role" class="select2" style="width: 100%"
                            autocomplete="off" required>
                        <option value="">Select</option>
                        <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($role->id); ?>"><?php echo e($role->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                    <a class="btn btn-primary"
                       href="<?php echo e(URL::previous()); ?>"> <?php echo e(__('views.admin.users.edit.cancel')); ?></a>
                    <button type="submit" class="btn btn-success"> <?php echo e(__('views.admin.users.edit.save')); ?></button>
                </div>
            </div>
            <?php echo e(Form::close()); ?>

        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('styles'); ?>
    ##parent-placeholder-bf62280f159b1468fff0c96540f3989d41279669##
    <?php echo e(Html::style(mix('assets/admin/css/users/edit.css'))); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    ##parent-placeholder-16728d18790deb58b3b8c1df74f06e536b532695##
    <?php echo e(Html::script(mix('assets/admin/js/users/edit.js'))); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>