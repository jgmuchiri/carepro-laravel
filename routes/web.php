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
})->name('index');

Auth::routes();
Route::get('/register/verify/{confirmationCode}', 'Auth\VerificationController@verify')->name('auth.verify');

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

    Route::get('/register/daycare', 'DaycaresController@create')->name('daycare.create');
    Route::post('/register/daycare', 'DaycaresController@store')->name('daycare.store');

    Route::get('/register/resend-verification-email', 'Auth\VerificationController@resendVerificationEmail')
        ->name('auth.resend-verification');
});
