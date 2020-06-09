<?php

use Illuminate\Support\Facades\Auth;
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

Auth::routes(['verify' => true]);

Route::get('/home', 'CustomerController@index')->middleware('verified')->name('home');

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
            Route::get('/create', 'Admin\CoffeeManagementController@create')->name('admins.manage.coffee.create');
            Route::get('/{id}', 'Admin\CoffeeManagementController@renderUpdateCoffeePage')->name('admins.manage.coffee.renderUpdateCoffeePage');
            Route::post('/', 'Admin\CoffeeManagementController@store')->name('admins.manage.coffee.store');
            Route::put('/{id}', 'Admin\CoffeeManagementController@update')->name('admins.manage.coffee.update');
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
        });

        Route::get('/', 'Admin\HomeController@renderAdminManagementPage')->middleware(['isSuperAdmin'])->name('admins.renderAdminManagementPage');
        Route::get('/{id}', 'Admin\HomeController@renderAdminDetailPage')->middleware(['isSuperAdmin'])->name('admins.renderAdminDetailPage');
    });
});

/* Api */
Route::get('/api/cities/{id}/districts', 'Api\CityController@getDistrictsByCityId');
Route::get('/api/districts/{id}/wards', 'Api\DistrictController@getWardsByDistrictsId');

/* User Routes */
Route::get('login/facebook', 'Auth\SocialAuthController@loginToFacebook');
Route::get('login/facebook/callback', 'Auth\SocialAuthController@callbackFacebook');
