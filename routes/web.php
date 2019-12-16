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
// Auth::routesForAdmin();

// Route::get('/home', 'HomeController@index')->name('home');
