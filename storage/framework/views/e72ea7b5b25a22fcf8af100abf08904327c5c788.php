<?php $__env->startSection('content'); ?>
    <!-- page content -->
    <!-- top tiles -->
    <div class="row tile_count">
        <div class="col-md-4 col-sm-4 col-xs-4 tile_stats_count">
            <a href="<?php echo e(route('admin.users')); ?>">
                <span class="count_top"><i class="fa fa-users"></i> Total Users</span>
                <div class="count green"><?php echo e($counts['customers']); ?></div>
            </a>
        </div>

        <div class="col-md-4 col-sm-4 col-xs-4 tile_stats_count">
            <a href="<?php echo e(route('admin.stores')); ?>">
                <span class="count_top"><i class="fa fa-users"></i> Total Stores</span>
                <div class="count green"><?php echo e($counts['stores']); ?></div>
            </a>
        </div>

        <div class="col-md-4 col-sm-4 col-xs-4 tile_stats_count">
            <a href="<?php echo e(route('admin.delivery_profiles')); ?>">
                <span class="count_top"><i class="fa fa-users"></i> Total Delivery Profiles</span>
                <div class="count green"><?php echo e($counts['deliveryProfiles']); ?></div>
            </a>
        </div>

    </div>


    <div class="row tile_count">
        <div class="col-md-4 col-sm-4 col-xs-4 tile_stats_count">
            <a href="<?php echo e(route('admin.orders')); ?>">
                <span class="count_top"><i class="fa fa-users"></i> Total Orders</span>
                <div class="count green"><?php echo e($orderCounts['total']); ?></div>
            </a>
        </div>

        <div class="col-md-4 col-sm-4 col-xs-4 tile_stats_count">
            <a href="<?php echo e(route('admin.orders')); ?>">
                <span class="count_top"><i class="fa fa-users"></i> Total Orders Cancelled</span>
                <div class="count green"><?php echo e($orderCounts['cancelled']); ?></div>
            </a>
        </div>

        <div class="col-md-4 col-sm-4 col-xs-4 tile_stats_count">
            <a href="<?php echo e(route('admin.orders')); ?>">
                <span class="count_top"><i class="fa fa-users"></i> Total Orders Pending</span>
                <div class="count green"><?php echo e($orderCounts['pending']); ?></div>
            </a>
        </div>


        <div class="col-md-12 col-sm-12 col-xs-12 tile_stats_count">
            <a href="<?php echo e(route('admin.emoneys')); ?>">
                <span class="count_top"><i class="fa fa-users"></i> Usuarios con monedero</span>
                <div class="count red"><?php echo e($emoneys); ?></div>
            </a>
        </div>

    </div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="dashboard_graph x_panel">
                <div class="row x_title">
                    <div class="col-md-3">
                        <h3>Active Orders</h3>
                    </div>
                </div>
                <div class="x_content">
                    <div class="demo-container">
                        <div id="map" class="demo-placeholder" style="height:800px"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Orders placed</h2>
                    <div class="filter">
                        <div id="orders-chart-range" class="pull-right"
                             style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc">
                            <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                            <span>December 30, 2014 - January 28, 2015</span> <b class="caret"></b>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="col-md-9 col-sm-12 col-xs-12">
                        <div class="demo-container" style="height:280px">
                            <div id="orders_chart" class="demo-placeholder"></div>
                        </div>
                        <div class="tiles">

                            <div class="col-md-4 tile">
                                <span>Total Orders</span>
                                <h2><?php echo e($orderCounts['total']); ?></h2>
                                <span class="orders_sparkline graph" style="height: 160px;">
                                    <canvas width="200" height="60"
                                            style="display: inline-block; vertical-align: top; width: 94px; height: 30px;"></canvas>
                                </span>
                            </div>

                            <div class="col-md-4 tile">
                                <span>Total Earnings</span>
                                <h2><?php echo e($earningsCount['total']); ?></h2>
                                <span class="revenue_sparkline graph" style="height: 160px;">
                                    <canvas width="200" height="60"
                                            style="display: inline-block; vertical-align: top; width: 94px; height: 30px;"></canvas>
                                </span>
                            </div>

                            <div class="col-md-4 tile">
                                <span>Total Stores</span>
                                <h2><?php echo e($counts['stores']); ?></h2>
                                <span class="earnings_sparkline graph" style="height: 160px;">
                                    <canvas width="200" height="60"
                                            style="display: inline-block; vertical-align: top; width: 94px; height: 30px;"></canvas>
                                </span>
                            </div>
                        </div>

                    </div>

                    <div class="col-md-3 col-sm-12 col-xs-12">
                        <div>
                            <div class="x_title">
                                <h2>Trending Stores</h2>
                                <div class="clearfix"></div>
                            </div>
                            <ul class="list-unstyled top_profiles scroll-view">
                                <?php $__currentLoopData = $trendingStores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $trendingStore): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li class="media event">
                                        <a class="pull-left border-aero profile_thumb">
                                            <i class="fa fa-cutlery aero"></i>
                                        </a>
                                        <div class="media-body" style="text-transform:capitalize">
                                            <a class="title"
                                               href="<?php echo e(route('admin.stores.show', ['store' => $trendingStore->store->id])); ?>"><?php echo e($trendingStore->store->name); ?></a>
                                            <p>
                                                <small><?php echo e($trendingStore->total); ?> sales</small>
                                            </p>
                                        </div>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="dashboard_graph x_panel">
                <div class="row x_title">
                    <div class="col-md-6">
                        <h3>User Registrations</h3>
                    </div>
                    <div class="col-md-6">
                        <div id="users-chart-range" class="pull-right"
                             style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc">
                            <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                            <span>December 30, 2014 - January 28, 2015</span> <b class="caret"></b>
                        </div>
                    </div>
                </div>
                <div class="x_content">
                    <div class="demo-container" style="height:250px">
                        <div id="users_chart" class="demo-placeholder"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    ##parent-placeholder-16728d18790deb58b3b8c1df74f06e536b532695##

    <script type="text/javascript">
        var ORDERS_DATA = [];
        <?php $__currentLoopData = $ordersChartData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $orderChartData): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        ORDERS_DATA.push([new Date("<?php echo e($orderChartData->created_at); ?>").getTime(), <?php echo e($orderChartData->total); ?>]);
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        var USERS_DATA = [];
        <?php $__currentLoopData = $usersChartData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $userChartData): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        USERS_DATA.push([new Date("<?php echo e($userChartData->created_at); ?>").getTime(), <?php echo e($userChartData->total); ?>]);
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        var URL_FETCH_ORDERS_CHART_DATA = "<?php echo e(route('admin.json.dashboard.ordersChartData')); ?>";
        var URL_FETCH_USERS_CHART_DATA = "<?php echo e(route('admin.json.dashboard.usersChartData')); ?>";
    </script>

    <?php echo e(Html::script(mix('assets/admin/js/dashboard.js'))); ?>


    <script>
        // map
        var map;
        var markers = [];
        var infoWindow, marker;

        function initMap() {
            var myLatLng = {
                lat: 28.66,
                lng: 70.60
            };

            map = new google.maps.Map(document.getElementById('map'), {
                zoom: 12,
                center: myLatLng
            });

            <?php $__currentLoopData = $activeOrders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                marker = new google.maps.Marker({
                map: map,
                position: {
                    lat: parseFloat('<?php echo e($order->address->latitude); ?>'),
                    lng: parseFloat('<?php echo e($order->address->longitude); ?>')
                }
            });

            marker.addListener('click', function () {
                new google.maps.InfoWindow({
                    content: '<div class="container col-xs-10">' +
                    '<div class="row"><div class="col-xs-12"><div class="page-header"><h3><a href="<?php echo e(route('admin.orders.show', ['id' => $order->id])); ?>">Order#<?php echo e($order->id); ?></h3></div></div></div>' +
                    '<div class="row form-group"><div class="col-xs-1 pull-left"><i class="fa fa-cutlery"></i></div><div class="col-xs-9 pull-left"><a href="<?php echo e(route('admin.stores.show', ['id' => $order->store->id])); ?>"><?php echo e($order->store->name); ?></a></div></div>' +
                    '<div class="row form-group"><div class="col-xs-1 pull-left"><i class="fa fa-user-o"></i></div><div class="col-xs-9 pull-left"><a href="<?php echo e(route('admin.users.show', ['id' => $order->user->id])); ?>"><?php echo e($order->user->fullname()); ?></a></div></div>' +
                    '<div class="row form-group"><div class="col-xs-1 pull-left"><i class="fa fa-info-circle"></i></div><div class="col-xs-9 pull-left" style="text-transform:capitalize"><?php echo e($order->status); ?></div></div>' +
                    '</div></div>'
                }).open(map, this);
            })
            markers.push(marker);
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            var bounds = new google.maps.LatLngBounds();
            for (var i = 0; i < markers.length; i++) {
                bounds.extend(markers[i].getPosition());
            }

            //center the map to the geometric center of all markers
            map.setCenter(bounds.getCenter());
            // adjust zoom levels
            google.maps.event.addListenerOnce(map, 'bounds_changed', function (event) {
                this.setZoom(map.getZoom() - 1);

                if (this.getZoom() > 12) {
                    this.setZoom(12);
                }
            });
            map.fitBounds(bounds);
        }
    </script>

    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyARLoZ3ZPKqOZWYYWq_jpaS_ScCiOvP55g&callback=initMap"
            type="text/javascript"></script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('styles'); ?>
    ##parent-placeholder-bf62280f159b1468fff0c96540f3989d41279669##
    <?php echo e(Html::style(mix('assets/admin/css/dashboard.css'))); ?>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('admin.layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>