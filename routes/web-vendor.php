<?php

/*
|--------------------------------------------------------------------------
| Web Vendor Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for Vendor
|
*/
Auth::routesForVendor();

Route::namespace('Vendor')->prefix('v')->group(function () {
    // Controllers Within The "App\Http\Controllers\Vendor" Namespace

	Route::get('/home', 'HomeController@index')->name('vendor.home');
});