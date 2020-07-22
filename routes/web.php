<?php

use App\Mail\NotifyOrderMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/* User Routes */

Route::get('/', 'HomeController@index')->name('customers.home');
Route::get('/intro', 'HomeController@renderIntroPage')->name('customers.intro');

Route::group(['prefix' => 'coffees'], function () {
    Route::get('/', 'CoffeeController@index')->name('customers.coffees.index');
    Route::get('/{slug}', 'CoffeeController@show')->name('customer.coffees.show');
});

Route::get('/carts', 'CartController@renderCartPage')->name('customer.cart');
Route::get('/checkout', 'CheckoutController@renderCheckoutPage')->name('customers.checkout.show');

Route::get('/search', 'SearchController@index')->name('customers.search.index');

Route::group(['prefix' => 'news'], function () {
    Route::get('/', 'NewsController@index')->name('customers.news.index');
    Route::get('/{slug}', 'NewsController@show')->name('customers.news.show');
});



Auth::routes(['verify' => true]);

Route::group(['prefix' => 'orders', 'middleware' => ['verified']], function () {
    Route::get('/', 'OrderController@index')->name('customers.orders.index');
    Route::post('/', 'OrderController@store')->name('customers.orders.store');
    Route::get('/{id}', 'OrderController@show')->name('customers.orders.show');
});

Route::group(['prefix' => 'accounts'], function () {
    Route::get('/', 'CustomerController@index')->middleware('verified')->name('customers.accounts.index');
    Route::put('/', 'CustomerController@update')->middleware('verified')->name('customers.accounts.update');
});

Route::group(['prefix' => 'addresses', 'middleware' => 'auth'], function () {
    Route::get('/', 'AddressController@index')->name('customers.addresses.index');
    Route::get('/create', 'AddressController@create')->name('customers.addresses.create');
    Route::get('/{id}', 'AddressController@show')->name('customers.addresses.show');
    Route::post('/', 'AddressController@store')->name('customers.addresses.store');
    Route::put('/changing', 'AddressController@changeDefaultAddress')->name('customers.addresses.changing');
    Route::put('/{id}', 'AddressController@update')->name('customers.addresses.update');
});

Route::group(['prefix' => 'rates', 'middleware' => 'auth'], function () {
    Route::get('/', 'RateController@index')->name('customers.rates.index');
});

/* Admin Routes */
Route::group(['prefix' => 'admins'], function () {
    Route::get('/home', 'Admin\HomeController@index')->name('admins.home');
    Route::get('/register', 'Admin\AuthForAdmin\RegisterController@showRegisterForm')->name('admins.register.show');
    Route::get('login', 'Admin\AuthForAdmin\LoginController@showLoginForm')->name('admins.login.show');
    Route::post('/register', 'Admin\AuthForAdmin\RegisterController@register')->name('admins.register.submit');
    Route::post('login', 'Admin\AuthForAdmin\LoginController@login')->name('admins.login.submit');

    Route::group(['prefix' => 'manage'], function () {

        Route::group(['prefix' => 'coffees'], function () {
            Route::get('/', 'Admin\CoffeeManagementController@index')->name('admins.manage.coffee.index');
            Route::get('/create', 'Admin\CoffeeManagementController@create')->middleware('isSuperAdmin')->name('admins.manage.coffee.create');
            Route::get('/{id}', 'Admin\CoffeeManagementController@renderUpdateCoffeePage')->middleware('isSuperAdmin')->name('admins.manage.coffee.renderUpdateCoffeePage');
            Route::post('/', 'Admin\CoffeeManagementController@store')->name('admins.manage.coffee.store');
            Route::put('/{id}', 'Admin\CoffeeManagementController@update')->middleware('isSuperAdmin')->name('admins.manage.coffee.update');
        });

        Route::group(['prefix' => 'warehouse'], function () {
            Route::get('/', 'Admin\WareHouseManagementController@index')->name('admins.manage.warehouse.index');
            Route::get('/create', 'Admin\WareHouseManagementController@create')->name('admins.manage.warehouse.create');
            Route::get('/{id}', 'Admin\WareHouseManagementController@renderInputDetailPage')->name('admins.manage.warehouse.renderInputDetailPage');
            Route::post('/', 'Admin\WareHouseManagementController@store')->name('admins.manage.warehouse.store');
        });

        Route::group(['prefix' => 'promotion'], function () {
            Route::get('/', 'Admin\PromotionManagementController@index')->name('admins.manage.promotion.index');
            Route::get('/create', 'Admin\PromotionManagementController@create')->name('admins.manage.promotion.create');
            Route::get('/{id}', 'Admin\PromotionManagementController@detail')->name('admins.manage.promotion.detail');
            Route::post('/', 'Admin\PromotionManagementController@store')->name('admins.manage.promotion.store');
        });

        Route::group(['prefix' => 'order'], function () {
            Route::get('/check', 'Admin\OrdermangentController@showAllCheckingOrder')->name('admins.manage.order.check.index');
            Route::get('/check/{id}', 'Admin\OrdermangentController@showDetailCheckingOrder')->name('admins.manage.order.check.show')->middleware('checkOrderStatus:1');
            Route::post('/check/{id}', 'Admin\OrdermangentController@updateToReceivedOrder')->name('admins.manage.order.receive.update');

            Route::get('/received', 'Admin\OrdermangentController@showAllReceivedOrder')->name('admins.manage.order.receive.index');
            Route::get('/received/{id}', 'Admin\OrdermangentController@showDetailReceiveOrder')->name('admins.manage.order.receive.show')->middleware('checkOrderStatus:2');
            Route::post('/received', 'Admin\OrdermangentController@addCoffeeForOrder')->name('admins.manage.order.receive.addCoffee');
            Route::post('/receive/{id}', 'Admin\OrdermangentController@updateToShipOrder')->name('admins.manage.order.ship.update');

            Route::get('/ship', 'Admin\OrdermangentController@showAllShipOrder')->name('admins.manage.order.ship.index');
            Route::get('/ship/{id}', 'Admin\OrdermangentController@showDetailShippingOrder')->name('admins.manage.order.ship.show')->middleware('checkOrderStatus:3');
            Route::post('/ship/{id}', 'Admin\OrdermangentController@updateToFinishOrder')->name('admins.manage.order.finish.update');

            Route::get('/finish', 'Admin\OrdermangentController@showAllFinishOrder')->name('admins.manage.order.finish.index');
            Route::get('/finish/{id}', 'Admin\OrdermangentController@showDetailFinishOrder')->name('admins.manage.order.finish.show')->middleware('checkOrderStatus:4');
        });

        Route::group(['prefix' => 'news'], function () {
            Route::get('/', 'Admin\NewsManagementController@index')->name('admins.manage.news.index');
            Route::get('/create', 'Admin\NewsManagementController@create')->name('admins.manage.news.create');
            Route::post('/create', 'Admin\NewsManagementController@store')->name('admins.manage.news.store');
        });

        Route::get('/', 'Admin\HomeController@renderAdminManagementPage')->middleware(['isSuperAdmin'])->name('admins.renderAdminManagementPage');
        Route::get('/{id}', 'Admin\HomeController@renderAdminDetailPage')->middleware(['isSuperAdmin'])->name('admins.renderAdminDetailPage');
    });
});

/* Api */
Route::group(['prefix' => 'api'], function () {
    Route::get('/cities/{id}/districts', 'Api\CityController@getDistrictsByCityId');
    Route::get('/districts/{id}/wards', 'Api\DistrictController@getWardsByDistrictsId');
    Route::get('/carts/{listCoffeeId}', 'Api\CartController@getCart');

    Route::group(['prefix' => 'comments'], function () {
        Route::post('/', 'Api\CommentController@storeCoffeeRatingComment')->middleware('auth');
        Route::post('/like', 'Api\CommentController@storeCommentLike')->middleware('auth');
        Route::post('/reply', 'Api\CommentController@storeReplyComment')->middleware('auth');
        Route::get('/reply', 'Api\CommentController@getReplyComment');
    });

    Route::group(['prefix' => 'favorites', 'middleware' => 'auth'], function () {
        Route::post('/', 'Api\CoffeeFavoriteController@handlingFavorite');
    });
});

/* User Routes */
Route::get('login/facebook', 'Auth\SocialAuthController@loginToFacebook');
Route::get('login/facebook/callback', 'Auth\SocialAuthController@callbackFacebook');

/* Testing */

Route::get('sendMail', function () {
    $details = [
        'title' => 'Mail from Hichi Coffee',
        'body' => 'This is testing mail'
    ];

    Mail::to('dacchi14101998@gmail.com')->send(new NotifyOrderMail($details));

    echo "SEND!";
});
