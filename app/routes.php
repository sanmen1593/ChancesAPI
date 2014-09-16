<?php

/*
  |--------------------------------------------------------------------------
  | Application Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register all of the routes for an application.
  | It's a breeze. Simply tell Laravel the URIs it should respond to
  | and give it the Closure to execute when that URI is requested.
  |
 */
Route::group(array('before' => 'checktoken'), function() {
    Route::resource('user', 'UserController');
    Route::get('registervehicle', 'VehicleController@create');
    Route::get('vehiclelist', 'VehicleController@index');
    Route::resource('vehicle', 'VehicleController');
    Route::get('chanceslist', 'ChanceController@index');
    Route::get('registerchance', 'ChanceController@create');
    Route::resource('chance', 'ChanceController');
    Route::resource('usersofchance', 'UsersofChanceController');
    Route::resource('comments', 'CommentsController');
    Route::resource('rated', 'RatedController');
    Route::get('profile', function() {
        $vehicle = Vehicle::where('users_id', '=', Auth::user()->id)->get();
        return View::make('users.profile')->with('vehicles', $vehicle);
    });
});

Route::get('/', 'SessionsController@create');

Route::get('login', 'SessionsController@create');
Route::get('logout', 'SessionsController@destroy');
Route::resource('sessions', 'SessionsController');
