<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
use \LaravelBook\Ardent\Ardent;

class User extends Ardent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

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
  protected $fillable = array('first_name','last_name','password', 'password_confirmation', 'email');

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

  public function afterValidate()
  {
    if($errors = $this->errors())
    {
      foreach($errors as $message)
      {
        Alert::error($message)->flash();
      }
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
