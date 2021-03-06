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

Route::get('/', function()
{
	return View::make('hello');
});
Route::get('register','AuthController@register');

Route::post('register','AuthController@registerUser');

Route::get('login','AuthController@login');
Route::post('login','AuthController@loginUser');

Route::group(['before' => 'auth'], function() {
  Route::controller('account', 'AccountController');
});

Route::get('myapp', function()
{
  return 'This is my app';
});

// Confide RESTful route
Route::get('account/confirm/{code}', 'UserController@getConfirm');
Route::get('account/reset/{token}', 'UserController@getReset');
Route::controller( 'account', 'AccountController');
