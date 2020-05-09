<?php $__env->startSection('title', 'View "' . $store->name . '"'); ?>)

<?php $__env->startSection('content'); ?>
    <div class="row">
        <table class="table table-striped table-hover">
            <tbody>

            <tr>
                <th>Owner</th>
                <td><a href="<?php echo e(route('admin.users.show', [$store->owner_id])); ?>"><?php echo e($store->owner_id); ?></a></td>
            </tr>

            <tr>
                <th>Name</th>
                <td><?php echo e($store->name); ?></td>
            </tr>

            <tr>
                <th>Tagline</th>
                <td><?php echo e($store->tagline); ?></td>
            </tr>

            <tr>
                <th>Image</th>
                <td><a href="<?php echo e($store->image_url); ?>" target="_blank"><?php echo e($store->image_url); ?></a></td>
            </tr>

            <tr>
                <th>Delivery Time</th>
                <td><?php echo e($store->delivery_time); ?></td>
            </tr>

            <tr>
                <th>Minimum Order</th>
                <td><?php echo e($store->minimum_order); ?></td>
            </tr>

            <tr>
                <th>Cost For Two</th>
                <td><?php echo e($store->cost_for_two); ?></td>
            </tr>

            <tr>
                <th>Delivery Fee</th>
                <td><?php echo e($store->delivery_fee); ?></td>
            </tr>

            <tr>
                <th>Details</th>
                <td><?php echo e($store->details); ?></td>
            </tr>

            <tr>
                <th>Delivery Limit (in meters)</th>
                <td><?php echo e($store->delivery_limit); ?></td>
            </tr>

            <tr>
                <th>Area</th>
                <td><?php echo e($store->area); ?></td>
            </tr>

            <tr>
                <th>Address</th>
                <td><?php echo e($store->address); ?></td>
            </tr>

            <tr>
                <th>Longitude</th>
                <td><?php echo e($store->longitude); ?></td>
            </tr>

            <tr>
                <th>Latitude</th>
                <td><?php echo e($store->latitude); ?></td>
            </tr>

            <tr>
                <th>Opens At</th>
                <td><?php echo e($store->opens_at); ?></td>
            </tr>

            <tr>
                <th>Closes At</th>
                <td><?php echo e($store->closes_at); ?></td>
            </tr>

            <tr>
                <th>Serves Non Veg?</th>
                <td><?php echo e($store->serves_non_veg); ?></td>
            </tr>

            <tr>
                <th>Preorder</th>
                <td><?php echo e($store->preorder); ?></td>
            </tr>

            <tr>
                <th>Status</th>
                <td><?php echo e($store->status); ?></td>
            </tr>

            <tr>
                <th>Categories</th>
                <td>
                    <?php $__currentLoopData = $store->categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a href="<?php echo e(route('admin.categories.edit', ['category' => $cat->id])); ?>"><?php echo e($cat->title); ?></a>,&nbsp;
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </td>
            </tr>

            <tr>
                <th>Created At</th>
                <td><?php echo e($store->created_at); ?> (<?php echo e($store->created_at->diffForHumans()); ?>)</td>
            </tr>

            <tr>
                <th>Updated At</th>
                <td><?php echo e($store->updated_at); ?> (<?php echo e($store->updated_at->diffForHumans()); ?>)</td>
            </tr>

            <tr>
                <th>Menu Items</th>
                <td><a href="<?php echo e(route('admin.menuitems', ['store' => $store->id])); ?>">View All</a></td>
            </tr>

            <tr>
                <th>Bank Details</th>
                <td><a href="<?php echo e(route('admin.bankdetails', ['user' => $store->owner_id])); ?>">View</a></td>
            </tr>

            <tr>
                <th>Orders</th>
                <td><a href="<?php echo e(route('admin.orders', ['store' => $store->id])); ?>">View All</a></td>
            </tr>

            <tr>
                <th>Earnings</th>
                <td><a href="<?php echo e(route('admin.earnings', ['user_id' => $store->owner_id])); ?>">View All</a></td>
            </tr>

            <tr>
                <th>Total Earnings</th>
                <td><?php echo e($earnings['total_earnings']); ?></td>
            </tr>

            <tr>
                <th>Unpaid Earnings</th>
                <td><?php echo e($earnings['unpaid_earnings']); ?></td>
            </tr>

            <tr>
                <th>Location on map</th>
                <td><div id="map" style="height: 500px;"></div></td>
            </tr>

            </tbody>
        </table>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    ##parent-placeholder-16728d18790deb58b3b8c1df74f06e536b532695##

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