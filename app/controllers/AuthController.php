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
    if(Auth::check())
    {
      Alert::info('You are already logged in!')->flash();
      return Redirect::to('account/profile');
    }
    else
    {
      return View::make('auth.register');
    }
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
      return Redirect::to('account/profile')->with('message','Thanks for register!');
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
    if(Auth::check())
    {
      Alert::info('You are already logged in!')->flash();
      return Redirect::to('account/profile');
    }
    else
    {
      return View::make('auth.login');
    }
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
      Alert::success('Successfully logged in!')->flash();
      return Redirect::to('account/profile');
    }
    Alert::error('The login doesn\'t work')->flash();
    return Redirect::to('login');
  }
}