<?php

use Illuminate\Http\Request;

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

Route::group(['middleware' => ['auth:api', 'subscribed']], function () {
    Route::resource('groups', 'GroupsController', ['except' => ['destroy']]);
    Route::resource('roles', 'RolesController', ['except' => 'show']);
    Route::get('/home', 'HomeController@index')->name('home');
    Route::resource('staff', 'StaffController', ['only' => ['store']]);
    Route::get('addresses/countries', 'AddressesController@countriesIndex')->name('addresses.countries.index');
    Route::post('parents/{id}/assign-children', 'ParentsController@assignChildren')
        ->name('parents.assign-children');
    Route::resource('parents', 'ParentsController', ['only' => ['index', 'store', 'show', 'update']]);

    Route::post('children/{id}/assign-parents', 'ChildrenController@assignParents')
        ->name('children.assign-parents');
    Route::post('children/{id}/assign-groups', 'ChildrenController@assignGroups')
        ->name('children.assign-groups');
    Route::resource('children/{id}/notes', 'NotesController', ['only' => ['store', 'index', 'show', 'destroy']]);
    Route::post('children/{id}/notes/{note_id}/email', 'NotesController@emailNote');
    Route::post('children/{id}/notes/{note_id}/photos', 'NotesController@addPhotos');
    Route::resource('children/{id}/photos', 'ChildPhotosController', ['only' => ['store', 'index']]);
    Route::resource('children/{id}/pickup-users', 'PickupUsersController', ['only' => ['store', 'update', 'destroy']]);
    Route::resource('children/{id}/emergency-contacts', 'EmergencyContactsController', ['only' => ['store', 'update', 'destroy']]);
    Route::resource('children/{id}/health-providers', 'HealthProvidersController', ['only' => ['store', 'update', 'destroy']]);
    Route::get('children/{id}/all-pickup-users', 'ChildrenController@getParents');
    Route::get('children/{id}/activate', 'ChildrenController@activate')->name('children.activate');
    Route::get('children/{id}/deactivate', 'ChildrenController@deactivate')->name('children.deactivate');
    Route::post('children/{id}/toggle-check-in', 'AttendanceController@toggleCheckIn')->name('children.toggle-check-in');
    Route::delete('children/{child_id}/groups/{group_id}', 'ChildrenController@unassignGroup')->name('children.groups.delete');
    Route::resource('children', 'ChildrenController', ['only' => ['index', 'create', 'store', 'show', 'edit', 'update']]);

    Route::put('staff/{staff_id}/add-to-group', 'StaffController@addToGroup')->name('staff.add-to-group');
    Route::put('staff/{staff_id}/update-password', 'StaffController@updatePassword')->name('staff.update-password');
    Route::resource('staff', 'StaffController', ['only' => ['index', 'store', 'update', 'edit']]);

    Route::get('children/{id}/attendance', 'AttendanceController@index');
    //medication
    Route::get('children/{id}/medication', 'MedicationController@index');
    Route::post('children/{id}/medication', 'MedicationController@store');
    Route::patch('children/{id}/medication/{medication_id}', 'MedicationController@update');
    Route::delete('children/{id}/medication/{medication_id}', 'MedicationController@destroy');
    //allergies
    Route::post('children/{id}/allergy', 'AllergyController@store');
    Route::patch('children/{id}/allergy/{allergy_id}', 'AllergyController@update');
    Route::delete('children/{id}/allergy/{allergy_id}', 'AllergyController@destroy');
    //food preferences
    Route::post('children/{id}/foodpreference', 'FoodpreferenceController@store');
    Route::patch('children/{id}/foodpreference/{preference_id}', 'FoodpreferenceController@update');
    Route::delete('children/{id}/foodpreference/{preference_id}', 'FoodpreferenceController@destroy');
    //invoices
    Route::get('/children/invoice/status', 'InvoiceController@status');
    Route::get('/children/invoice/transactions/types', 'InvoiceController@transactionTypes');
    Route::get('children/{id}/invoice', 'InvoiceController@index');
    Route::post('children/{id}/invoice', 'InvoiceController@store');
    Route::get('children/{id}/invoice/{invoice_id}', 'InvoiceController@show');
    Route::patch('children/{id}/invoice/{invoice_id}', 'InvoiceController@update');
    Route::delete('children/{id}/invoice/{invoice_id}', 'InvoiceController@destroy');
    //pay invoice
    Route::post('children/{id}/invoice/{invoice_id}/pay', 'InvoiceController@payInvoice');
    Route::post('children/{id}/invoice/{invoice_id}/manual-pay', 'InvoiceController@manualpayInvoice');
});
