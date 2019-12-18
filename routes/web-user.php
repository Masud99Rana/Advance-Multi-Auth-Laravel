<?php


/*
|--------------------------------------------------------------------------
| Web User Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for User
|
*/


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();


Route::namespace('User')->group(function () {
    // Controllers Within The "App\Http\Controllers\User" Namespace

	Route::get('/home', 'HomeController@index')->name('user.home')->middleware('userIsVerified');
});



