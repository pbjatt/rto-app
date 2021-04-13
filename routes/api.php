<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['namespace' => 'api'], function () {
    Route::get('/rto', 'RtoController@index');
    Route::get('/address', 'AddressController@index');
    Route::get('/age', 'AgeController@index');
    Route::get('/cc_model', 'CubicCapacityController@index');
    Route::post('/idv_rate', 'IdvrateController@index');
    Route::post('/price', 'PriceController@index');

    Route::get('/type', 'TypeController@index');

    Route::get('/healthplanprice', 'HealthController@healthplanprice');
    Route::get('/familysize', 'HealthController@familysize');
    Route::get('/healthplan', 'HealthController@healthplan');
    Route::get('/healthage', 'HealthController@healthage');
    Route::get('/healthzone', 'HealthController@healthzone');
    Route::get('/company', 'HealthController@company');

    Route::get('/check_username', 'RegisterController@checkusername');
    Route::post('/register', 'RegisterController@register');
    Route::post('/otp_verify', 'RegisterController@verifyotp');
    Route::post('/mail_verify', 'RegisterController@verifymail');
    Route::post('/send_otp', 'RegisterController@sendotp');
    Route::post('/send_otp_mail', 'RegisterController@sendotpmail');

    Route::post('/login', 'LoginController@login');
    Route::post('/forgotpassword', 'LoginController@forgotpassword');
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(['namespace' => 'api', 'middleware' => 'auth:api'], function () {

    Route::get('/logout', 'LoginController@logout');
    Route::get('/slider', 'SliderController@index');
    Route::get('/home', 'HomeController@index');

    Route::get('/signature', 'SignatureController@index');
    Route::post('/signature', 'SignatureController@update');

    Route::post('/profile', 'UserController@profile');

    Route::get('/quotation', 'QuotationController@index');
    Route::post('/quotation', 'QuotationController@store');
    Route::get('/quotation/pdf/{id}', 'QuotationController@quotation_pdf');
});
Route::group(['namespace' => 'api'], function () {
    // Route::get('/quotation/pdf/{id}', 'QuotationController@quotation_pdf');
});
