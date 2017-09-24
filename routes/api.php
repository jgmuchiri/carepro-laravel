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
    Route::resource('groups', 'GroupsController', ['only' => ['index', 'store', 'show', 'create']]);
    Route::resource('roles', 'RolesController', ['except' => 'show']);
});
