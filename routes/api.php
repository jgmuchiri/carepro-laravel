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

Route::group(['middleware' => ['auth:api', 'subscribed']], function() {
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
    Route::resource('children/{id}/notes', 'NotesController', ['only' => ['store', 'index']]);
    Route::resource('children/{id}/photos', 'ChildPhotosController', ['only' => ['store', 'index']]);
    Route::resource('children/{id}/pickup-users', 'PickupUsersController', ['only' => ['store', 'update', 'destroy']]);
    Route::get('children/{id}/activate', 'ChildrenController@activate')->name('children.activate');
    Route::get('children/{id}/deactivate', 'ChildrenController@deactivate')->name('children.deactivate');
    Route::delete('children/{child_id}/groups/{group_id}', 'ChildrenController@unassignGroup')->name('children.groups.delete');
    Route::resource('children', 'ChildrenController', ['only' => ['index', 'create', 'store', 'show', 'edit', 'update']]);

    Route::put('staff/{staff_id}/add-to-group', 'StaffController@addToGroup')->name('staff.add-to-group');
    Route::put('staff/{staff_id}/update-password', 'StaffController@updatePassword')->name('staff.update-password');
    Route::resource('staff', 'StaffController', ['only' => ['index', 'store', 'update', 'edit']]);
});
