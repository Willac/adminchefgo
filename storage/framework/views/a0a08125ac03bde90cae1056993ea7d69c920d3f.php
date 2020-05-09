<?php $__env->startSection('content'); ?>
    <div class="x_panel">
        <div class="x_title">
            <h2>Configurations</h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <br/>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <?php echo e(Form::open(['route'=>['admin.settings.updateSetting'],'method' => 'put','class'=>'form-horizontal form-label-left'])); ?>


                    <?php $__currentLoopData = $settings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $setting): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="<?php echo e($setting->key); ?>">
                                    <?php echo e(title_case(str_replace('_', ' ', $setting->key))); ?>

                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="<?php echo e($setting->key); ?>" type="text"
                                           class="form-control col-md-7 col-xs-12"
                                           name="<?php echo e($setting->key); ?>" value="<?php echo e($setting->value); ?>">
                                </div>
                            </div>
                        
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                            <button type="submit"
                                    class="btn btn-success"> <?php echo e(__('views.admin.users.edit.save')); ?></button>
                        </div>
                    </div>
                    <?php echo e(Form::close()); ?>

                </div>
            </div>
        </div>
    </div>

    <div class="x_panel">
        <div class="x_title">
            <h2>Environment Variables</h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <br/>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <?php echo e(Form::open(['route'=>['admin.settings.updateEnv'],'method' => 'put','class'=>'form-horizontal form-label-left', 'enctype' => 'multipart/form-data'])); ?>


                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="APP_NAME">
                            APP_NAME
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="APP_NAME" type="text"
                                   class="form-control col-md-7 col-xs-12"
                                   name="APP_NAME" value="<?php echo e($env['APP_NAME'] ?? ''); ?>" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="APP_URL">
                            APP_URL
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="APP_URL" type="text"
                                   class="form-control col-md-7 col-xs-12"
                                   name="APP_URL" value="<?php echo e($env['APP_URL'] ?? ''); ?>" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="APP_LOGO">
                            APP_LOGO
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="APP_LOGO" type="file"
                                   class="form-control col-md-7 col-xs-12"
                                   name="APP_LOGO">
                            <a href="<?php echo e($env['APP_LOGO'] ?? ''); ?>" target="_blank"><?php echo e($env['APP_LOGO'] ?? ''); ?></a>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ADMIN_NOTIFICATIONS">
                            ADMIN_NOTIFICATIONS
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="ADMIN_NOTIFICATIONS" type="text"
                                   class="form-control col-md-7 col-xs-12"
                                   name="ADMIN_NOTIFICATIONS" value="<?php echo e($env['ADMIN_NOTIFICATIONS'] ?? ''); ?>" required>
                            <label>Possible values: true or false</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ADMIN_NOTIFICATION_CHANNELS">
                            ADMIN_NOTIFICATION_CHANNELS
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="ADMIN_NOTIFICATION_CHANNELS" type="text"
                                   class="form-control col-md-7 col-xs-12"
                                   name="ADMIN_NOTIFICATION_CHANNELS" value="<?php echo e($env['ADMIN_NOTIFICATION_CHANNELS'] ?? ''); ?>" required>
                            <label>Possible values: database,mail,broadcast</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                            <button type="submit"
                                    class="btn btn-success"> <?php echo e(__('views.admin.users.edit.save')); ?></button>
                        </div>
                    </div>
                    <?php echo e(Form::close()); ?>

                </div>
            </div>
        </div>
    </div>

    <div class="x_panel">
        <div class="x_title">
            <h2>FCM Settings</h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <br/>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <?php echo e(Form::open(['route'=>['admin.settings.updateEnv'],'method' => 'put','class'=>'form-horizontal form-label-left'])); ?>


                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="FCM_SERVER_KEY">
                            FCM_SERVER_KEY
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="FCM_SERVER_KEY" type="text"
                                   class="form-control col-md-7 col-xs-12"
                                   name="FCM_SERVER_KEY" value="<?php echo e($env['FCM_SERVER_KEY'] ?? ''); ?>" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="FCM_SERVER_KEY">
                            FCM_SENDER_ID
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="FCM_SERVER_KEY" type="text"
                                   class="form-control col-md-7 col-xs-12"
                                   name="FCM_SERVER_KEY" value="<?php echo e($env['FCM_SERVER_KEY'] ?? ''); ?>" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                            <button type="submit"
                                    class="btn btn-success"> <?php echo e(__('views.admin.users.edit.save')); ?></button>
                        </div>
                    </div>
                    <?php echo e(Form::close()); ?>

                </div>
            </div>
        </div>
    </div>


    <div class="x_panel">
        <div class="x_title">
            <h2>Email Settings
                <small>Active mail driver: <?php echo e($env['MAIL_DRIVER']); ?></small>
            </h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <br/>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <?php echo e(Form::open(['route'=>['admin.settings.updateEnv'],'method' => 'put','class'=>'form-horizontal form-label-left'])); ?>


                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="MAIL_FROM_ADDRESS">
                            MAIL_FROM_ADDRESS
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="MAIL_FROM_ADDRESS" type="email"
                                   class="form-control col-md-7 col-xs-12"
                                   name="MAIL_FROM_ADDRESS" value="<?php echo e($env['MAIL_FROM_ADDRESS'] ?? ''); ?>" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="MAIL_FROM_NAME">
                            MAIL_FROM_NAME
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="MAIL_FROM_NAME" type="text"
                                   class="form-control col-md-7 col-xs-12"
                                   name="MAIL_FROM_NAME" value="<?php echo e($env['MAIL_FROM_NAME'] ?? ''); ?>" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                            <button type="submit"
                                    class="btn btn-success"> <?php echo e(__('views.admin.users.edit.save')); ?></button>
                        </div>
                    </div>
                    <?php echo e(Form::close()); ?>

                </div>
            </div>

            <br/>

            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="" role="tabpanel" data-example-id="togglable-tabs">
                        <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                            <li role="presentation" class="<?php if($env['MAIL_DRIVER'] == 'mailgun'): ?> active <?php endif; ?>"><a
                                        href="#tab_content1" id="tab1" role="tab"
                                        data-toggle="tab" aria-expanded="true">Mailgun</a>
                            </li>

                            <li role="presentation" class="<?php if($env['MAIL_DRIVER'] == 'ses'): ?> active <?php endif; ?>"><a
                                        href="#tab_content2" id="tab2" role="tab"
                                        data-toggle="tab" aria-expanded="true">Amazon SES</a>

                            <li role="presentation" class="<?php if($env['MAIL_DRIVER'] == 'sparkpost'): ?> active <?php endif; ?>"><a
                                        href="#tab_content3" id="tab3" role="tab"
                                        data-toggle="tab" aria-expanded="true">Sparkpost</a>

                            <li role="presentation" class="<?php if($env['MAIL_DRIVER'] == 'smtp'): ?> active <?php endif; ?>"><a
                                        href="#tab_content4" role="tab" id="tab4"
                                        data-toggle="tab" aria-expanded="false">SMTP</a>
                            </li>

                            <li role="presentation" class="<?php if($env['MAIL_DRIVER'] == 'sendmail'): ?> active <?php endif; ?>"><a
                                        href="#tab_content5" role="tab" id="tab5"
                                        data-toggle="tab" aria-expanded="false">Sendmail</a>
                            </li>
                        </ul>
                        <div id="myTabContent" class="tab-content">
                            <div role="tabpanel"
                                 class="tab-pane fade in <?php if($env['MAIL_DRIVER'] == 'mailgun'): ?> active <?php endif; ?>"
                                 id="tab_content1"
                                 aria-labelledby="tab1">
                                <?php echo e(Form::open(['route'=>['admin.settings.updateEnv'],'method' => 'put','class'=>'form-horizontal form-label-left'])); ?>


                                <input type="hidden" name="MAIL_DRIVER" value="mailgun">

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="MAILGUN_DOMAIN">
                                        MAILGUN_DOMAIN
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="MAILGUN_DOMAIN" type="text"
                                               class="form-control col-md-7 col-xs-12"
                                               name="MAILGUN_DOMAIN" value="<?php echo e($env['MAILGUN_DOMAIN'] ?? ''); ?>" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="MAILGUN_SECRET">
                                        MAILGUN_SECRET
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="MAILGUN_SECRET" type="text"
                                               class="form-control col-md-7 col-xs-12"
                                               name="MAILGUN_SECRET" value="<?php echo e($env['MAILGUN_SECRET'] ?? ''); ?>" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                        <button type="submit"
                                                class="btn btn-success">Activate
                                        </button>
                                    </div>
                                </div>
                                <?php echo e(Form::close()); ?>

                            </div>

                            <div role="tabpanel"
                                 class="tab-pane fade in <?php if($env['MAIL_DRIVER'] == 'ses'): ?> active <?php endif; ?>"
                                 id="tab_content2" aria-labelledby="tab2">
                                <?php echo e(Form::open(['route'=>['admin.settings.updateEnv'],'method' => 'put','class'=>'form-horizontal form-label-left'])); ?>


                                <input type="hidden" name="MAIL_DRIVER" value="ses">

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="SES_KEY">
                                        SES_KEY
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="SES_KEY" type="text"
                                               class="form-control col-md-7 col-xs-12"
                                               name="SES_KEY" value="<?php echo e($env['SES_KEY'] ?? ''); ?>" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="SES_SECRET">
                                        SES_SECRET
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="SES_SECRET" type="text"
                                               class="form-control col-md-7 col-xs-12"
                                               name="SES_SECRET" value="<?php echo e($env['SES_SECRET'] ?? ''); ?>" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                        <button type="submit"
                                                class="btn btn-success">Activate
                                        </button>
                                    </div>
                                </div>
                                <?php echo e(Form::close()); ?>

                            </div>

                            <div role="tabpanel"
                                 class="tab-pane fade in <?php if($env['MAIL_DRIVER'] == 'sparkpost'): ?> active <?php endif; ?>"
                                 id="tab_content3" aria-labelledby="tab3">
                                <?php echo e(Form::open(['route'=>['admin.settings.updateEnv'],'method' => 'put','class'=>'form-horizontal form-label-left'])); ?>


                                <input type="hidden" name="MAIL_DRIVER" value="sparkpost">

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="SPARKPOST_SECRET">
                                        SPARKPOST_SECRET
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="SPARKPOST_SECRET" type="text"
                                               class="form-control col-md-7 col-xs-12"
                                               name="SPARKPOST_SECRET" value="<?php echo e($env['SPARKPOST_SECRET'] ?? ''); ?>"
                                               required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                        <button type="submit"
                                                class="btn btn-success">Activate
                                        </button>
                                    </div>
                                </div>
                                <?php echo e(Form::close()); ?>

                            </div>

                            <div role="tabpanel"
                                 class="tab-pane fade in <?php if($env['MAIL_DRIVER'] == 'smtp'): ?> active <?php endif; ?>"
                                 id="tab_content4" aria-labelledby="tab4">
                                <?php echo e(Form::open(['route'=>['admin.settings.updateEnv'],'method' => 'put','class'=>'form-horizontal form-label-left'])); ?>


                                <input type="hidden" name="MAIL_DRIVER" value="smtp">

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="MAIL_HOST">
                                        MAIL_HOST
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="MAIL_HOST" type="text"
                                               class="form-control col-md-7 col-xs-12"
                                               name="MAIL_HOST" value="<?php echo e($env['MAIL_HOST'] ?? ''); ?>" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="MAIL_PORT">
                                        MAIL_PORT
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="MAIL_PORT" type="text"
                                               class="form-control col-md-7 col-xs-12"
                                               name="MAIL_PORT" value="<?php echo e($env['MAIL_PORT'] ?? ''); ?>" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="MAIL_USERNAME">
                                        MAIL_USERNAME
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="MAIL_USERNAME" type="text"
                                               class="form-control col-md-7 col-xs-12"
                                               name="MAIL_USERNAME" value="<?php echo e($env['MAIL_USERNAME'] ?? ''); ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="MAIL_PASSWORD">
                                        MAIL_PASSWORD
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="MAIL_PASSWORD" type="text"
                                               class="form-control col-md-7 col-xs-12"
                                               name="MAIL_PASSWORD" value="<?php echo e($env['MAIL_PASSWORD'] ?? ''); ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="MAIL_PASSWORD">
                                        MAIL_PASSWORD
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="MAIL_PASSWORD" type="text"
                                               class="form-control col-md-7 col-xs-12"
                                               name="MAIL_PASSWORD" value="<?php echo e($env['MAIL_PASSWORD'] ?? ''); ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="MAIL_ENCRYPTION">
                                        MAIL_ENCRYPTION
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="MAIL_ENCRYPTION" type="text"
                                               class="form-control col-md-7 col-xs-12"
                                               name="MAIL_ENCRYPTION" value="<?php echo e($env['MAIL_ENCRYPTION'] ?? ''); ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                        <button type="submit"
                                                class="btn btn-success">Activate
                                        </button>
                                    </div>
                                </div>
                                <?php echo e(Form::close()); ?>

                            </div>
                            <div role="tabpanel"
                                 class="tab-pane fade in <?php if($env['MAIL_DRIVER'] == 'sendmail'): ?> active <?php endif; ?>"
                                 id="tab_content5" aria-labelledby="tab5">
                                <?php echo e(Form::open(['route'=>['admin.settings.updateEnv'],'method' => 'put','class'=>'form-horizontal form-label-left'])); ?>


                                <input type="hidden" name="MAIL_DRIVER" value="sendmail">
                                <div class="form-group">
                                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                        <button type="submit"
                                                class="btn btn-success">Activate
                                        </button>
                                    </div>
                                </div>
                                <?php echo e(Form::close()); ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="x_panel">
        <div class="x_title">
            <h2>Payment Gateway Settings</h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <br/>

            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="" role="tabpanel" data-example-id="togglable-tabs">
                        <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                            <li role="presentation" class="active"><a
                                        href="#tab_content1" id="tab1" role="tab"
                                        data-toggle="tab" aria-expanded="true">Stripe</a>
                            </li>
                        </ul>
                        <div id="myTabContent" class="tab-content">
                            <div role="tabpanel"
                                 class="tab-pane fade in active"
                                 id="tab_content1"
                                 aria-labelledby="tab1">
                                <?php echo e(Form::open(['route'=>['admin.settings.updateEnv'],'method' => 'put','class'=>'form-horizontal form-label-left'])); ?>


                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="STRIPE_KEY">
                                        STRIPE_KEY
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="STRIPE_KEY" type="text"
                                               class="form-control col-md-7 col-xs-12"
                                               name="STRIPE_KEY" value="<?php echo e($env['STRIPE_KEY'] ?? ''); ?>" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="STRIPE_SECRET">
                                        STRIPE_SECRET
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="STRIPE_SECRET" type="text"
                                               class="form-control col-md-7 col-xs-12"
                                               name="STRIPE_SECRET" value="<?php echo e($env['STRIPE_SECRET'] ?? ''); ?>" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                        <button type="submit"
                                                class="btn btn-success">Activate
                                        </button>
                                    </div>
                                </div>
                                <?php echo e(Form::close()); ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="x_panel">
        <div class="x_title">
            <h2>Pusher <small>(Required if you're using <code>broadcast</code> in <code>ADMIN_NOTIFICATION_CHANNELS</code>)</small></h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <br/>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <?php echo e(Form::open(['route'=>['admin.settings.updateEnv'],'method' => 'put','class'=>'form-horizontal form-label-left', 'enctype' => 'multipart/form-data'])); ?>


                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="PUSHER_APP_ID">
                            PUSHER_APP_ID
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="PUSHER_APP_ID" type="text"
                                   class="form-control col-md-7 col-xs-12"
                                   name="PUSHER_APP_ID" value="<?php echo e($env['PUSHER_APP_ID'] ?? ''); ?>" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="PUSHER_APP_KEY">
                            PUSHER_APP_KEY
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="PUSHER_APP_KEY" type="text"
                                   class="form-control col-md-7 col-xs-12"
                                   name="PUSHER_APP_KEY" value="<?php echo e($env['PUSHER_APP_KEY'] ?? ''); ?>" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="PUSHER_APP_SECRET">
                            PUSHER_APP_SECRET
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="PUSHER_APP_SECRET" type="text"
                                   class="form-control col-md-7 col-xs-12"
                                   name="PUSHER_APP_SECRET" value="<?php echo e($env['PUSHER_APP_SECRET'] ?? ''); ?>" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="PUSHER_APP_CLUSTER">
                            PUSHER_APP_CLUSTER
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="PUSHER_APP_CLUSTER" type="text"
                                   class="form-control col-md-7 col-xs-12"
                                   name="PUSHER_APP_CLUSTER" value="<?php echo e($env['PUSHER_APP_CLUSTER'] ?? ''); ?>" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                            <button type="submit"
                                    class="btn btn-success"> <?php echo e(__('views.admin.users.edit.save')); ?></button>
                        </div>
                    </div>
                    <?php echo e(Form::close()); ?>

                </div>
            </div>
        </div>
    </div>

    
        
            
            
        
        
            
            
                
                    

                    
                        
                            
                        
                        
                            
                                      
                        
                    

                    
                        
                            
                        
                        
                            
                                      
                                      
                        
                    

                    
                        
                            
                        
                        
                            
                                      
                                      
                        
                    

                    
                        
                            
                                    
                        
                    
                    
                
            
        
    
<?php $__env->stopSection(); ?>

<?php $__env->startSection('styles'); ?>
    ##parent-placeholder-bf62280f159b1468fff0c96540f3989d41279669##
    <?php echo e(Html::style(mix('assets/admin/css/users/edit.css'))); ?>

<?php $__env->stopSection(); ?>


    
        
    
    
    
    

    
        
            
            
            
        
    

<?php echo $__env->make('admin.layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>