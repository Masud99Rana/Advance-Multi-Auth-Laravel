<?php

/*
|--------------------------------------------------------------------------
| Web Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for Admin
|
*/
Auth::routesForAdmin();

Route::namespace('Admin')->prefix('admin')->group(function () {
    // Controllers Within The "App\Http\Controllers\Admin" Namespace

	Route::get('/home', 'HomeController@index')->name('admin.home')->middleware('userIsVerified');
});