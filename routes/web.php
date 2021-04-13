<?php

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

Route::get('/', function () {
    return view('welcome');
});


Route::group(['middleware' => 'guest', 'prefix' => 'admin'], function () {
    Route::any('/login', 'LoginController@index')->name('login');
    Route::post('main/checklogin', 'LoginController@checklogin')->name('checklogin');
});

Route::group(['middleware' => 'auth', 'prefix' => 'admin'], function () {
    Route::get('logout', 'LoginController@logout')->name('logout');
    Route::get('/', 'DashboardController@index')->name('admin-home');
});

Route::group(['middleware' => 'auth', 'as' => 'admin.', 'prefix' => 'admin'], function () {

    Route::resources([
        'age' => 'AgeController',
        'cubiccapacity' => 'CubicCapacityController',
        'idv' => 'IdvrateController',
        'price' => 'PriceController'
    ]);
    Route::get('idv-list/{category}', 'IdvrateController@master')->name('idv-list');
    Route::get('price-list/{category}', 'PriceController@master')->name('price-list');

    Route::resources([
        'slider' => 'SliderController',
        'tool' => 'ToolController',
        'type' => 'TypeController',
    ]);

    Route::resources([
        'company' => 'CompanyController',
        'healthzone' => 'HealthZoneController',
        'familysize' => 'FamilySizeController',
        'healthage' => 'HealthAgeController',
        'healthplan' => 'HealthPlanController',
        'healthplanprice' => 'HealthPlanPriceController',
    ]);
    Route::get('health/master', 'HealthPlanPriceController@master');

    Route::group(['prefix' => 'user'], function () {
        Route::get('/', 'UserController@list')->name('users-list');
    });


    Route::group(['prefix' => 'profile'], function () {
        Route::get('/', 'LoginController@profile')->name('profile');
        Route::post('/', 'LoginController@edit_profile')->name('profile');
    });

    Route::group(['prefix' => 'setting'], function () {
        Route::get('/', 'SettingController@edit')->name('setting');
        Route::post('/', 'SettingController@update')->name('setting');
    });

    Route::post('ajex/changeoption', 'AjexController@changeoption')->name('ajex');
});
