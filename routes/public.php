<?php

/*
|--------------------------------------------------------------------------
| Public API Routes
|--------------------------------------------------------------------------
|
| These routes below are belong to "api" middleware, configured
| in RouteServiceProvider using Dingo/Api.
|
*/

Route::post('login', 'APIAuthentication@login')->name('api.login');
