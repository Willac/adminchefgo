<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::namespace('Api')->name('api.')->group(function () {

    Route::namespace('Auth')->group(function () {
        Route::post('/login', 'LoginController@authenticate')->name('login');
        Route::post('/register', 'RegisterController@register')->name('register');
        Route::post('/verify-mobile', 'RegisterController@verifyMobile')->name('verifyMobile');
        Route::post('/forgot-password', 'RegisterController@sendResetLinkEmail')->name('forgotPassword');
    });

    Route::post('/support', 'SupportController@store')->name('support.store');

    // system wide settings
    Route::get('/settings', 'SettingController@index')->name('setting.index');

    Route::middleware('auth:api')->group(function () {

        Route::get('/user', function (Request $request) {
            return $request->user();
        })->name('home');
        Route::put('/user', 'UserController@update')->name('user.update');

        Route::get('emoneys/getAmount/', 'EMoneyController@getAmount')->name('getAmount');
        Route::put('emoneys/updateAmount/', 'EMoneyController@updateAmount')->name('updateAmount');

        //emoneys
        Route::get('emoneys', 'EMoneyController@index')->name('emoneys');
        Route::get('emoneys/create', 'EMoneyController@create')->name('emoneys.create');
        Route::post('emoneys', 'EMoneyController@store')->name('emoneys.store');
        Route::get('emoneys/{emoney}/edit', 'EMoneyController@edit')->name('emoneys.edit');
        Route::put('emoneys/{emoney}', 'EMoneyController@update')->name('emoneys.update');


        


        //Conekta
        Route::get('conekta/cards/', 'ConektaController@cards');
        Route::put('conekta/addCardUser', 'ConektaController@addCard');
        Route::delete('conekta/deleteCard/{token_id}', 'ConektaController@deleteCard');
        Route::put('conekta/generatePay', 'ConektaController@generatePay');
        Route::put('conekta/generateReference', 'ConektaController@generateReference');

        // user earnings
        Route::get('/earnings', 'EarningController@index')->name('earning.index');
        Route::get('/earnings/{earning}', 'EarningController@show')->name('earning.show');

        // user cards
        Route::get('/cards', 'CardController@index')->name('card.index');
        Route::get('/cards/{card}', 'CardController@show')->name('card.show');


        /* Store related APIs */
        // get store of current logged in user
        Route::get('/store', 'StoreController@show')->name('store.show');
        // update store        
        Route::put('/store/update', 'StoreController@update')->name('store.update');
        Route::put('/store/updateStatus', 'StoreController@updateStatus')->name('store.updateStatus');

        Route::get('/menuitem', 'MenuItemController@index')->name('menuitem.index');
        Route::post('/menuitem', 'MenuItemController@store')->name('menuitem.store');
        Route::get('/menuitem/{menuItem}', 'MenuItemController@show')->name('menuitem.show');
        Route::post('/menuitem/{menuItem}', 'MenuItemController@update')->name('menuitem.update');
        Route::post('/menuitem/{menuItem}/update-status', 'MenuItemController@updateStatus')->name('menuitem.updateStatus');
        Route::delete('/menuitem/{menuItem}', 'MenuItemController@destroy')->name('menuitem.destroy');

        Route::get('/bank-detail', 'BankDetailController@show')->name('bankdetail.show');
        Route::post('/bank-detail', 'BankDetailController@store')->name('bankdetail.store');

        Route::get('/category', 'CategoryController@index')->name('category.index');

        /* order related */
        // get a list of orders of a logged in user's store
        Route::post('/order/getDeliveryActives', 'OrderController@getDeliveryActives')->name('order.getDeliveryActives');
        Route::put('/order/{order}/cancelOrder', 'OrderController@cancelOrder')->name('order.cancelOrder');
        Route::put('/order/{order}/cancelOrderCustomer', 'OrderController@cancelOrderCustomer')->name('order.cancelOrderCustomer');
        Route::post('/order/{order}/stampMail', 'OrderController@stampMail')->name('order.stampMail');
        Route::get('/order', 'OrderController@index')->name('order.index');
        Route::get('/order/{order}', 'OrderController@show')->name('order.show');
        Route::put('/order/{order}', 'OrderController@update')->name('order.update');

        // get a list of reviews of a logged in user's store
        Route::get('/rating', 'RatingController@index')->name('rating.index');

        /* Customer related APIs */
        Route::namespace('Customer')->prefix('customer')->name('customer.')->group(function () {
            Route::get('/category', 'CategoryController@index')->name('category.index');

            // list of store
            Route::get('/store', 'StoreController@index')->name('store.index');

            // show store by id
            Route::get('/store/{store}', 'StoreController@show')->name('store.show');

            // Get a list of favourite
            Route::get('/favourite', 'FavouriteController@index')->name('favourite.index');

            // mark store as favourite
            Route::post('/favourite/{store}', 'FavouriteController@store')->name('favourite.store');

            // get a rating of a stores rated by current user
            Route::get('/rating/me', 'RatingController@show')->name('rating.show');

            // get a list of ratings
            Route::get('/rating/{store}', 'RatingController@index')->name('rating.index');

            // rate a store
            Route::post('/rating/{store}', 'RatingController@store')->name('rating.store');


            //Duplicar rutas para la evaluación de los repartidores
            Route::get('/rate_deliver/me', 'DeliveryRatingController@show')->name('delivery_rating.show');

            // get a list of ratings
            Route::get('/rate_deliver/{delivery_profile}', 'DeliveryRatingController@index')->name('delivery_rating.index');
            // rate a store
            Route::post('/rate_deliver/{delivery_profile}', 'DeliveryRatingController@store')->name('delivery_rating.store');



            // check coupon validity
            Route::get('/coupon-validity', 'CouponController@couponValidity')->name('coupon.validity');

            /* address related */
           
            Route::get('/address', 'AddressController@index')->name('address.index');
            Route::post('/address', 'AddressController@store')->name('address.store');
            Route::get('/address/{address}', 'AddressController@show')->name('address.show');
            Route::delete('/address/{address}', 'AddressController@delete')->name('address.delete');
            Route::put('/address/{address}/update', 'AddressController@update')->name('address.update');

            /* orders related */
            // get a list of orders of a current user
            
            
            Route::get('/order', 'OrderController@index')->name('order.index');
            Route::post('/order', 'OrderController@store')->name('order.store');
            Route::get('/payment-methods', 'PaymentMethodController@index')->name('paymentmethod.index');
        });

        /* Customer related APIs */
        Route::namespace('Delivery')->prefix('delivery')->name('delivery.')->group(function () {
            Route::get('/profile', 'DeliveryProfileController@show')->name('profile.show');
            // update delivery profile
            Route::put('/profile/update', 'DeliveryProfileController@update')->name('profile.update');

            Route::get('/order', 'OrderController@showAvailableOrder')->name('order.showAvailableOrder');
            Route::put('/update-delivery-status/{order}', 'OrderController@updateDeliveryStatus')->name('order.updateDeliveryStatus');
            Route::put('/update-acceptance-status/{order}', 'OrderController@updateAcceptedStatus')->name('order.updateAcceptedStatus');
        });
    });
});
