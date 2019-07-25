<?php

/*
|--------------------------------------------------------------------------
| Protected API Routes
|--------------------------------------------------------------------------
|
| These routes below are belong to "api" and "api.auth" middleware, configured
| in RouteServiceProvider using Dingo/Api.
|
 */

Route::get('/', 'APIAuthentication@index')->name('api.index');

Route::group(['prefix' => 'users'], function () {
    Route::get('/', 'UserController@index')->name('users.index');
    Route::post('/', 'UserController@store')->name('users.store');
    Route::get('{user}', 'UserController@show')->name('users.show');
    Route::put('{user}', 'UserController@update')->name('users.update');
    Route::delete('{user}', 'UserController@destroy')->name('users.destroy');
});

Route::group(['prefix' => 'permissions'], function () {
    Route::get('/', 'PermissionController@index')->name('permissions.index');
    Route::get('{permission}', 'PermissionController@show')->name('permissions.show');
});

Route::group(['prefix' => 'roles'], function () {
    Route::get('/', 'RoleController@index')->name('roles.index');
    Route::get('{role}', 'RoleController@show')->name('roles.show');
    Route::put('{role}/permissions', 'RoleController@syncPermissions')->name('roles.permissions');
});

