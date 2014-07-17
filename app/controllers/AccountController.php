<?php

class AccountController extends \BaseController {

  /**
   * Display a listing of the resource.
   * GET /account/profile
   *
   * @return Response
   */
  public function getProfile()
  {
    return View::make('account.profile')->with('user',Auth::user());
  }

  public function postProfile()
  {
    $user = User::find(Auth::user()->id);
    $user->fill(Input::all());
    if ($user->exists)
    {
      $user::$rules['password'] = (Input::get('password')) ? 'required|between:8,32|confirmed' : '';
      $user::$rules['password_confirmation'] = (Input::get('password')) ? 'required|between:8,32' : '';
    }
    if($user->updateUniques())
    {
      Alert::success('Profile was updated!')->flash();
      return Redirect::to('account/profile');
    }
    else
    {
      return Redirect::to('account/profile')->withErrors($user->errors());
    }
  }

  /**
   * Displays the form for account creation
   *
   */
  public function getSignup()
  {
    return View::make(Config::get('confide::signup_form'));
  }

  /**
   * Stores new account
   *
   */
  public function postSignup()
  {
    $user = new User;

//    $user->username = Input::get( 'username' );
//    $user->email = Input::get( 'email' );
//    $user->password = Input::get( 'password' );
//
//    // The password confirmation will be removed from model
//    // before saving. This field will be used in Ardent's
//    // auto validation.
//    $user->password_confirmation = Input::get( 'password_confirmation' );

    // Save if valid. Password field will be hashed before save
    $user->save();

    if ( $user->getKey() )
    {
      $notice = Lang::get('confide::confide.alerts.account_created') . ' ' . Lang::get('confide::confide.alerts.instructions_sent');
      Alert::notice($notice)->flash();
      // Redirect with success message, You may replace "Lang::get(..." for your custom message.
      return Redirect::to('account/login');
    }
    else
    {
      // Get validation errors (see Ardent package)
      $errors = $user->errors();

      return Redirect::to('account/signup')
        ->withInput(Input::except('password'))
        ->withErrors( $errors );
    }
  }

  /**
   * Displays the login form
   *
   */
  public function getLogin()
  {
    if( Confide::user() )
    {
      // If user is logged, redirect to internal
      // page, change it to '/admin', '/dashboard' or something
      return Redirect::to('/');
    }
    else
    {
      return View::make(Config::get('confide::login_form'));
    }
  }

  /**
   * Attempt to do login
   *
   */
  public function postLogin()
  {
    $input = array(
      'email'    => Input::get( 'email' ), // May be the username too
      'username' => Input::get( 'username' ), // so we have to pass both
      'password' => Input::get( 'password' ),
      'remember' => Input::get( 'remember' ),
    );

    // If you wish to only allow login from confirmed users, call logAttempt
    // with the second parameter as true.
    // logAttempt will check if the 'email' perhaps is the username.
    // Get the value from the config file instead of changing the controller
    if ( Confide::logAttempt( $input, Config::get('confide::signup_confirm') ) )
    {
      // Redirect the user to the URL they were trying to access before
      // caught by the authentication filter IE Redirect::guest('user/login').
      // Otherwise fallback to '/'
      // Fix pull #145
      return Redirect::intended('/'); // change it to '/admin', '/dashboard' or something
    }
    else
    {
      $user = new User;

      // Check if there was too many login attempts
      if( Confide::isThrottled( $input ) )
      {
        $err_msg = Lang::get('confide::confide.alerts.too_many_attempts');
      }
      elseif( $user->checkUserExists( $input ) and ! $user->isConfirmed( $input ) )
      {
        $err_msg = Lang::get('confide::confide.alerts.not_confirmed');
      }
      else
      {
        $err_msg = Lang::get('confide::confide.alerts.wrong_credentials');
      }
      Alert::error($err_msg)->flash();
      return Redirect::to('account/login')
        ->withInput(Input::except('password'));
    }
  }

  /**
   * Attempt to confirm account with code
   *
   * @param    string  $code
   */
  public function getConfirm( $code )
  {
    if ( Confide::confirm( $code ) )
    {
      $notice_msg = Lang::get('confide::confide.alerts.confirmation');
      return Redirect::to('user/login')
        ->with( 'notice', $notice_msg );
    }
    else
    {
      $error_msg = Lang::get('confide::confide.alerts.wrong_confirmation');
      return Redirect::to('user/login')
        ->with( 'error', $error_msg );
    }
  }

  /**
   * Displays the forgot password form
   *
   */
  public function getForgot()
  {
    return View::make(Config::get('confide::forgot_password_form'));
  }

  /**
   * Attempt to send change password link to the given email
   *
   */
  public function postForgot()
  {
    if( Confide::forgotPassword( Input::get( 'email' ) ) )
    {
      $notice_msg = Lang::get('confide::confide.alerts.password_forgot');
      return Redirect::to('user/login')
        ->with( 'notice', $notice_msg );
    }
    else
    {
      $error_msg = Lang::get('confide::confide.alerts.wrong_password_forgot');
      return Redirect::to('user/forgot')
        ->withInput()
        ->with( 'error', $error_msg );
    }
  }

  /**
   * Shows the change password form with the given token
   *
   */
  public function getReset( $token )
  {
    return View::make(Config::get('confide::reset_password_form'))
      ->with('token', $token);
  }

  /**
   * Attempt change password of the user
   *
   */
  public function postReset()
  {
    $input = array(
      'token'=>Input::get( 'token' ),
      'password'=>Input::get( 'password' ),
      'password_confirmation'=>Input::get( 'password_confirmation' ),
    );

    // By passing an array with the token, password and confirmation
    if( Confide::resetPassword( $input ) )
    {
      $notice_msg = Lang::get('confide::confide.alerts.password_reset');
      return Redirect::to('user/login')
        ->with( 'notice', $notice_msg );
    }
    else
    {
      $error_msg = Lang::get('confide::confide.alerts.wrong_password_reset');
      return Redirect::to('user/reset/'.$input['token'])
        ->withInput()
        ->with( 'error', $error_msg );
    }
  }

  /**
   * Log the user out of the application.
   *
   */
  public function getLogout()
  {
    Confide::logout();

    return Redirect::to('/');
  }

//  /**
//   * Show the form for creating a new resource.
//   * GET /users/create
//   *
//   * @return Response
//   */
//  public function create()
//  {
//    //
//  }
//
//  /**
//   * Store a newly created resource in storage.
//   * POST /users
//   *
//   * @return Response
//   */
//  public function store()
//  {
//    //
//  }
//
//  /**
//   * Display the specified resource.
//   * GET /users/{id}
//   *
//   * @param  int  $id
//   * @return Response
//   */
//  public function show($id)
//  {
//    //
//  }
//
//  /**
//   * Display the specified resource.
//   * GET /users/{id}
//   *
//   * @param  int  $id
//   * @return Response
//   */
//  public function show($id)
//  {
//    //
//  }
//
//  /**
//   * Show the form for editing the specified resource.
//   * GET /users/{id}/edit
//   *
//   * @param  int  $id
//   * @return Response
//   */
//  public function edit($id)
//  {
//    //
//  }
//
//  /**
//   * Update the specified resource in storage.
//   * PUT /users/{id}
//   *
//   * @param  int  $id
//   * @return Response
//   */
//  public function update($id)
//  {
//    //
//  }
//
//  /**
//   * Remove the specified resource from storage.
//   * DELETE /users/{id}
//   *
//   * @param  int  $id
//   * @return Response
//   */
//  public function destroy($id)
//  {
//    //
//  }

}