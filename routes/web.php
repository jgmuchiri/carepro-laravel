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
    Route::get('/subscribe', 'SubscriptionController@showBilling')->name('subscriptions.subscribe');

    Route::post('/subscribe', 'SubscriptionController@subscribe')->name('subscriptions.subscribe');
    Route::get('/subscribe/{plan_name}/start-free-trial', 'SubscriptionController@subscribeToTrial')
        ->name('subscriptions.subscribe-to-trial');
    Route::delete('/subscription/cancel', 'SubscriptionController@cancel')->name('subscriptions.cancel');
    Route::get('/subscription/resume', 'SubscriptionController@resume')->name('subscriptions.resume');
    Route::post('/subscription/update-credit-card', 'SubscriptionController@updateCreditCard')
        ->name('subscriptions.update-credit-card');

    Route::get('/register/daycare', 'DaycaresController@create')->name('daycare.create');
    Route::post('/register/daycare', 'DaycaresController@store')->name('daycare.store');

    Route::get('/register/resend-verification-email', 'Auth\VerificationController@resendVerificationEmail')
        ->name('auth.resend-verification');

    Route::get('/account/profile', 'AccountsController@showProfile')->name('account.profile');

    Route::resource('roles', 'RolesController', ['except' => 'show']);
});

Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function() {
    Route::get('settings', 'SettingsController@edit')->name('admin.settings.edit');
    Route::post('settings/{id}', 'SettingsController@update')->name('admin.settings.update');
});
