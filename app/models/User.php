<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends \LaravelBook\Ardent\Ardent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

  /**
   * The rules for the validation of the user
   *
   * @var array
   */
  public static $rules = array(
    'name'                  => 'required|between:4,16',
    'email'                 => 'required|email'
  );

  /**
   *  The varaibles that are available in mass assignment
   *
   * @var array
   */
  protected $fillable = array('name', 'email');

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
