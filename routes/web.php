<?php

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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::post(
    'stripe/webhook',
    '\Laravel\Cashier\Http\Controllers\WebhookController@handleWebhook'
);

Route::get('/plans', 'SubscriptionController@showPlans')->name('plans');

Route::group(['middleware' => 'auth'], function() {
    Route::get('/subscribe', 'SubscriptionController@show')->name('billing');

    Route::post('/subscribe', 'SubscriptionController@subscribe')->name('billing');
    Route::get('/subscribe/{plan_name}/start-free-trial', 'SubscriptionController@subscribeToTrial')
        ->name('subscribe.trial');

    Route::get('/register/daycare', 'DaycareController@create')->name('daycare.create');
});

