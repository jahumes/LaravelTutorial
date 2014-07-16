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
Route::get('register','UsersController@register');

Route::post('register','UsersController@registerUser');

Route::get('login','UsersController@login');
Route::post('login','UsersController@loginUser');

Route::get('profile', function()
{
  if (Auth::check())
  {
    return 'Welcome! You have been authorized!';
  }
  else
  {
    return 'Please <a href="login">Login</a>';
  }
});
