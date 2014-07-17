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
      Alert::success('Profile was updated!');
      return Redirect::to('account/profile');
    }
    else
    {
      return Redirect::to('account/profile')->withInput();
    }
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