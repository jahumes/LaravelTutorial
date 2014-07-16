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

  /**
   * The rules for the validation of the user
   *
   * @var array
   */
  public static $rules = array(
      'email'       => 'required|email|unique:users',
      'password'    => 'required|alpha_num|between:8,32|confirmed',
      'password_confirmation' => 'required|alpha_num|between:8,32',
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

}
