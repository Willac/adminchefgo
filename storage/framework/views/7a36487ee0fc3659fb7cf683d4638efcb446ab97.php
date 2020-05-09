<?php $__env->startSection('title', 'Edit "' . $store->name . '"' ); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <?php echo e(Form::open(['route'=>['admin.stores.update', $store->id],'method' => 'put','class'=>'form-horizontal form-label-left'])); ?>


            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name" >
                    Name
                    <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input id="name" type="text" class="form-control col-md-7 col-xs-12 <?php if($errors->has('name')): ?> parsley-error <?php endif; ?>"
                           name="name" value="<?php echo e($store->name); ?>" required>
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
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tagline" >
                    Tagline
                    <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input id="tagline" type="text" class="form-control col-md-7 col-xs-12 <?php if($errors->has('tagline')): ?> parsley-error <?php endif; ?>"
                           name="tagline" value="<?php echo e($store->tagline); ?>" required>
                    <?php if($errors->has('tagline')): ?>
                        <ul class="parsley-errors-list filled">
                            <?php $__currentLoopData = $errors->get('tagline'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="parsley-required"><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="image_url" >
                    Image Url
                    <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input id="image_url" type="text" class="form-control col-md-7 col-xs-12 <?php if($errors->has('image_url')): ?> parsley-error <?php endif; ?>"
                           name="image_url" value="<?php echo e($store->image_url); ?>" required>
                    <?php if($errors->has('image_url')): ?>
                        <ul class="parsley-errors-list filled">
                            <?php $__currentLoopData = $errors->get('image_url'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="parsley-required"><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="delivery_time" >
                    Delivery Time
                    <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input id="delivery_time" type="text" class="form-control col-md-7 col-xs-12 <?php if($errors->has('delivery_time')): ?> parsley-error <?php endif; ?>"
                           name="delivery_time" value="<?php echo e($store->delivery_time); ?>" required>
                    <?php if($errors->has('delivery_time')): ?>
                        <ul class="parsley-errors-list filled">
                            <?php $__currentLoopData = $errors->get('delivery_time'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="parsley-required"><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="minimum_order" >
                    Minimum Order
                    <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input id="minimum_order" type="text" class="form-control col-md-7 col-xs-12 <?php if($errors->has('minimum_order')): ?> parsley-error <?php endif; ?>"
                           name="minimum_order" value="<?php echo e($store->minimum_order); ?>" required>
                    <?php if($errors->has('minimum_order')): ?>
                        <ul class="parsley-errors-list filled">
                            <?php $__currentLoopData = $errors->get('minimum_order'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="parsley-required"><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cost_for_two" >
                    Cost For Two
                    <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input id="cost_for_two" type="text" class="form-control col-md-7 col-xs-12 <?php if($errors->has('cost_for_two')): ?> parsley-error <?php endif; ?>"
                           name="cost_for_two" value="<?php echo e($store->cost_for_two); ?>" required>
                    <?php if($errors->has('cost_for_two')): ?>
                        <ul class="parsley-errors-list filled">
                            <?php $__currentLoopData = $errors->get('cost_for_two'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="parsley-required"><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="delivery_fee" >
                    Delivery Fee
                    <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input id="delivery_fee" type="text" class="form-control col-md-7 col-xs-12 <?php if($errors->has('delivery_fee')): ?> parsley-error <?php endif; ?>"
                           name="delivery_fee" value="<?php echo e($store->delivery_fee); ?>" required>
                    <?php if($errors->has('delivery_fee')): ?>
                        <ul class="parsley-errors-list filled">
                            <?php $__currentLoopData = $errors->get('delivery_fee'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="parsley-required"><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="details" >
                    Details
                    <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input id="details" type="text" class="form-control col-md-7 col-xs-12 <?php if($errors->has('details')): ?> parsley-error <?php endif; ?>"
                           name="details" value="<?php echo e($store->details); ?>" required>
                    <?php if($errors->has('details')): ?>
                        <ul class="parsley-errors-list filled">
                            <?php $__currentLoopData = $errors->get('details'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="parsley-required"><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="delivery_limit" >
                    Delivery Limit (in meters)
                    <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input id="delivery_limit" type="text" class="form-control col-md-7 col-xs-12 <?php if($errors->has('delivery_limit')): ?> parsley-error <?php endif; ?>"
                           name="delivery_limit" value="<?php echo e($store->delivery_limit); ?>" required>
                    <?php if($errors->has('delivery_limit')): ?>
                        <ul class="parsley-errors-list filled">
                            <?php $__currentLoopData = $errors->get('delivery_limit'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="parsley-required"><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="area" >
                    Area
                    <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input id="area" type="text" class="form-control col-md-7 col-xs-12 <?php if($errors->has('area')): ?> parsley-error <?php endif; ?>"
                           name="area" value="<?php echo e($store->area); ?>" required>
                    <?php if($errors->has('area')): ?>
                        <ul class="parsley-errors-list filled">
                            <?php $__currentLoopData = $errors->get('area'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="parsley-required"><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="address" >
                    Address
                    <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input id="address" type="text" class="form-control col-md-7 col-xs-12 <?php if($errors->has('address')): ?> parsley-error <?php endif; ?>"
                           name="address" value="<?php echo e($store->address); ?>" required>
                    <?php if($errors->has('address')): ?>
                        <ul class="parsley-errors-list filled">
                            <?php $__currentLoopData = $errors->get('address'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="parsley-required"><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="latitude" >
                    Latitude
                    <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input id="latitude" type="text" class="form-control col-md-7 col-xs-12 <?php if($errors->has('latitude')): ?> parsley-error <?php endif; ?>"
                           name="latitude" value="<?php echo e($store->latitude); ?>" required>
                    <?php if($errors->has('latitude')): ?>
                        <ul class="parsley-errors-list filled">
                            <?php $__currentLoopData = $errors->get('latitude'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="parsley-required"><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="longitude" >
                    Longitude
                    <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input id="longitude" type="text" class="form-control col-md-7 col-xs-12 <?php if($errors->has('longitude')): ?> parsley-error <?php endif; ?>"
                           name="longitude" value="<?php echo e($store->longitude); ?>" required>
                    <?php if($errors->has('longitude')): ?>
                        <ul class="parsley-errors-list filled">
                            <?php $__currentLoopData = $errors->get('longitude'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="parsley-required"><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="opens_at" >
                    Opens At
                    <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input id="opens_at" type="time" class="form-control col-md-7 col-xs-12 <?php if($errors->has('opens_at')): ?> parsley-error <?php endif; ?>"
                           name="opens_at" value="<?php echo e($store->opens_at); ?>" required>
                    <?php if($errors->has('opens_at')): ?>
                        <ul class="parsley-errors-list filled">
                            <?php $__currentLoopData = $errors->get('opens_at'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="parsley-required"><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="closes_at" >
                    Closes At
                    <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input id="closes_at" type="time" class="form-control col-md-7 col-xs-12 <?php if($errors->has('closes_at')): ?> parsley-error <?php endif; ?>"
                           name="closes_at" value="<?php echo e($store->closes_at); ?>" required>
                    <?php if($errors->has('closes_at')): ?>
                        <ul class="parsley-errors-list filled">
                            <?php $__currentLoopData = $errors->get('closes_at'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="parsley-required"><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="serves_non_veg" >
                    Serves non veg?
                    <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input id="serves_non_veg" type="text" class="form-control col-md-7 col-xs-12 <?php if($errors->has('serves_non_veg')): ?> parsley-error <?php endif; ?>"
                           name="serves_non_veg" value="<?php echo e($store->serves_non_veg); ?>" required>
                    <?php if($errors->has('serves_non_veg')): ?>
                        <ul class="parsley-errors-list filled">
                            <?php $__currentLoopData = $errors->get('serves_non_veg'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="parsley-required"><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="preorder" >
                    Preorder?
                    <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input id="preorder" type="text" class="form-control col-md-7 col-xs-12 <?php if($errors->has('preorder')): ?> parsley-error <?php endif; ?>"
                           name="preorder" value="<?php echo e($store->preorder); ?>" required>
                    <?php if($errors->has('preorder')): ?>
                        <ul class="parsley-errors-list filled">
                            <?php $__currentLoopData = $errors->get('preorder'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="parsley-required"><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="status">
                    Status
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <select id="status" name="status" class="select2" style="width: 100%" autocomplete="off">
                        <option <?php if($store->status == 'open'): ?> selected="selected" <?php endif; ?> value="open">Open</option>
                        <option <?php if($store->status == 'close'): ?> selected="selected" <?php endif; ?> value="close">Close</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                    <a class="btn btn-primary" href="<?php echo e(URL::previous()); ?>"> <?php echo e(__('views.admin.users.edit.cancel')); ?></a>
                    <button type="submit" class="btn btn-success"> <?php echo e(__('views.admin.users.edit.save')); ?></button>
                </div>
            </div>

            <div class="form-group" style="margin-top: 30px;">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">
                    Location on map
                </label>
                <div class="col-sm-9 col-xs-12">
                    <div id="map" style="height: 500px;" class="col-xs-9"></div>
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


    <script>
        // map
        var map;
        var marker;
        function initMap() {
            var myLatLng = {lat: parseFloat('<?php echo e($store->latitude); ?>'), lng: parseFloat('<?php echo e($store->longitude); ?>')};

            map = new google.maps.Map(document.getElementById('map'), {
                zoom: 10,
                center: myLatLng
            });

            marker = new google.maps.Marker({
                map: map,
                position: myLatLng
            });

            console.log(marker);
        }
    </script>

    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyARLoZ3ZPKqOZWYYWq_jpaS_ScCiOvP55g&callback=initMap"
            type="text/javascript"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>