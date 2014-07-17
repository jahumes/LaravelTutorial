<?php

class AuthController extends \BaseController
{
  /**
   * Display the form for registering a new user
   * GET /register
   *
   * @return Response
   */
  public function register()
  {
    return View::make('users.register');
  }

  /**
   * Registers a user for the site
   * POST /register
   *
   * @return Redirect
   */
  public function registerUser()
  {
    $user = new User;

    if($user->save())
    {
      Auth::loginUsingId($user->id);
      return Redirect::to('users/profile')->with('message','Thanks for register!');
    }
    else
    {
      return Redirect::to('register')->withErrors($user->errors())->withInput();
    }
  }

  /**
   * Displays the login page
   * GET /login
   *
   * @return Response
   */
  public function login()
  {
    return View::make('users.login');
  }

  /**
   * Logs a user in
   * POST /login
   *
   * @return mixed
   */
  public function loginUser()
  {
    $user = array(
      'email' => Input::get('email'),
      'password' => Input::get('password')
    );

    if (Auth::attempt($user))
    {

      return Redirect::to('users/profile');
    }
    die();
    return Redirect::to('login')->withError(array('login_error'=>'Your username and password are invalid'));
  }
}