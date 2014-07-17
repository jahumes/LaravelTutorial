<?php

use Zizaco\Confide\ConfideUser;

class User extends ConfideUser {

  public $autoHydrateEntityFromInput = true;

  public $autoPurgeRedundantAttributes = true;

  public static $passwordAttributes = array('password');

  public $autoHashPasswordAttributes = true;

  /**
   * The rules for the validation of the user
   *
   * @var array
   */
  public static $rules = array(
    'email'       => 'required|email|unique:users',
    'username' => 'required|alpha_dash|unique:users',
    'password'    => 'required|between:8,32|confirmed',
    'password_confirmation' => 'required|between:8,32',
    'first_name'  => 'required',
    'last_name'   => 'required'
  );

  /**
   *  The varaibles that are available in mass assignment
   *
   * @var array
   */
  protected $fillable = array('username','first_name','last_name','password', 'password_confirmation', 'email');

  /**
   * The database table used by the model.
   *
   * @var string
   */
  protected $table = 'users';

  /**
   * The attributes excluded from the model's JSON form.
   *
   * @var array
   */
  protected $hidden = array('password', 'remember_token');

  public function beforeValidate()
  {
    if($this->exists && $this->isDirty('password') && $this->password == '')
    {
      $this->password = $this->original['password'];
      unset($this->attributes['password_confirmation']);
    }

    return true;
  }

  /**
   * Displays the full name of the user
   *
   * @param bool $reversed Should the name be reversed
   * @return string The name
   */
  public function fullName( $reversed = false )
  {
    if($reversed)
      return $this->last_name . ', ' . $this->first_name;
    else
      return $this->first_name . ' ' . $this->last_name;
  }

}
