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
Route::get('/subscribe', 'SubscriptionController@show')->middleware('auth')->name('billing');

Route::post('/subscribe', 'SubscriptionController@subscribe')->middleware('auth')->name('billing');
Route::get('/subscribe/{plan_name}/start-free-trial', 'SubscriptionController@subscribeToTrial')->middleware('auth')->name('subscribe.trial');
