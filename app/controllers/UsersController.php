<?php

class UsersController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /users
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

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
      return Redirect::to('profile')->with('message','Thanks for register!');
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


  public function loginUser()
  {
    $user = array(
      'email' => Input::get('email'),
      'password' => Input::get('password')
    );

    if (Auth::attempt($user))
    {

      return Redirect::to('profile');
    }
    die();
    return Redirect::to('login')->withError(array('login_error'=>'Your username and password are invalid'));
  }

	/**
	 * Show the form for creating a new resource.
	 * GET /users/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /users
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /users/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /users/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /users/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /users/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}