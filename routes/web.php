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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->middleware('verified')->name('home');

/* Admin Routes */
Route::group(['prefix' => 'admins'], function () {
    Route::get('/home', 'Admin\HomeController@index')->name('admins.home');
    Route::get('/register', 'Admin\AuthForAdmin\RegisterController@showRegisterForm')->name('admins.register.show');
    Route::get('login', 'Admin\AuthForAdmin\LoginController@showLoginForm')->name('admins.login.show');
    Route::post('/register', 'Admin\AuthForAdmin\RegisterController@register')->name('admins.register.submit');
    Route::post('login', 'Admin\AuthForAdmin\LoginController@login')->name('admins.login.submit');

    Route::group(['prefix' => 'manage'], function () {
        Route::group(['prefix' => 'coffees'], function () {
            Route::get('/', 'Admin\AdminCoffeeManagementController@index')->name('admins.manage.coffee.index');
            Route::get('/create', 'Admin\AdminCoffeeManagementController@create')->name('admins.manage.coffee.create');
            Route::post('/', 'Admin\AdminCoffeeManagementController@store')->name('admins.manage.coffee.store');
        });
    });
});

/* User Routes */
Route::get('login/facebook', 'Auth\SocialAuthController@loginToFacebook');
Route::get('login/facebook/callback', 'Auth\SocialAuthController@callbackFacebook');
