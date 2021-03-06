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

//front-end plans..
Route::get('/', 'PagesController@index')->name('index');
Auth::routes();
Route::get('/register/verify/{confirmationCode}', 'Auth\VerificationController@verify')->name('auth.verify');

Route::get('/plans', 'PagesController@plans')->name('plans');
Route::get('/contact', 'PagesController@contact')->name('contact');
Route::post('/contact', 'PagesController@contactUs')->name('contact.us');

Route::get('/subscribe/{plan_name}/start-free-trial', 'SubscriptionController@subscribeToTrial')
    ->name('subscriptions.subscribe-to-trial');

//backend routes
Route::group(['middleware' => 'auth'], function () {
    Route::get('/subscribe', 'SubscriptionController@showBilling')->name('subscriptions.subscribe');

    Route::post('/subscribe', 'SubscriptionController@subscribe')->name('subscriptions.subscribe');
    Route::delete('/subscription/cancel', 'SubscriptionController@cancel')->name('subscriptions.cancel');
    Route::get('/subscription/resume', 'SubscriptionController@resume')->name('subscriptions.resume');
    Route::post('/subscription/update-credit-card', 'SubscriptionController@updateCreditCard')
        ->name('subscriptions.update-credit-card');
    Route::get('/subscription/change-plan/{plan_name}', 'SubscriptionController@updateSubscription')
        ->name('subscriptions.change-plan');

    Route::get('/register/daycare', 'DaycaresController@create')->name('daycare.create');
    Route::post('/register/daycare', 'DaycaresController@store')->name('daycare.store');

    Route::get('/register/resend-verification-email', 'Auth\VerificationController@resendVerificationEmail')
        ->name('auth.resend-verification');

    Route::get('/account/profile', 'AccountsController@showProfile')->name('account.profile');

    Route::get('/children/{id}/invoice/{invoice_id}', 'ChildrenController@invoice');
    Route::get('children/{id}/attendance/print', 'AttendanceController@print');

    Route::group(
        [
            'namespace' => 'Admin',
            'prefix' => 'admin',
            'middleware' => 'can:update,App\Models\Subscriptions\Plan'
        ],
        function () {
            Route::get('settings', 'SettingsController@edit')->name('admin.settings.edit');
            Route::post('settings/{id}', 'SettingsController@update')->name('admin.settings.update');
        }
    );

    Route::get('invoices', 'InvoicesController@index')->name('invoices.index');
    Route::get('invoices/{id}/downlaod', 'InvoicesController@download')->name('invoices.download');

    Route::get('{any?}', 'PagesController@dashboard')->where('any', '.*');
});
