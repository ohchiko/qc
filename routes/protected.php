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
    Route::put('{user}/role', 'UserController@assignRole')->name('users.role');
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

Route::group(['prefix' => 'purchases'], function () {
    Route::get('/', 'PurchaseController@index')->name('purchases.index');
    Route::post('/', 'PurchaseController@store')->name('purchases.store');
    Route::get('{purchase}', 'PurchaseController@show')->name('purchases.show');
    Route::put('{purchase}', 'PurchaseController@update')->name('purchases.update');
    Route::delete('{purchase}', 'PurchaseController@destroy')->name('purchases.destroy');
});

Route::group(['prefix' => 'works'], function () {
    Route::get('/', 'WorkController@index')->name('works.index');
    Route::post('/', 'WorkController@store')->name('works.store');
    Route::get('{work}', 'WorkController@show')->name('works.show');
    Route::put('{work}', 'WorkController@update')->name('works.update');
    Route::delete('{work}', 'WorkController@destroy')->name('works.destroy');
});

Route::group(['prefix' => 'products'], function () {
    Route::get('/', 'ProductController@index')->name('products.index');
    Route::post('/', 'ProductController@store')->name('products.store');
    Route::get('{product}', 'ProductController@show')->name('products.show');
    Route::put('{product}', 'ProductController@update')->name('products.update');
    Route::delete('{product}', 'ProductController@destroy')->name('products.destroy');
});

Route::group(['prefix' => 'materials'], function () {
    Route::get('/', 'MaterialController@index')->name('materials.index');
    Route::post('/', 'MaterialController@store')->name('materials.store');
    Route::get('{material}', 'MaterialController@show')->name('materials.show');
    Route::put('{material}', 'MaterialController@update')->name('materials.update');
    Route::delete('{material}', 'MaterialController@destroy')->name('materials.destroy');
});

