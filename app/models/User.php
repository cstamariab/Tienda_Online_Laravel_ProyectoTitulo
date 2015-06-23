<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	
	protected $table = 'users';
	public $timestamps = false;


	protected $hidden = array('password', 'remember_token');


		public function Ordenes()
		{
			return $this->hasMany('Orden','user_id');
		}


	public function getAuthIdentifier()
	{
	  return $this->getKey();
	}


	public function getAuthPassword()
	{
	  return $this->password;
	}
	 
	/**
	 * Get the e-mail address where password reminders are sent.
	 *
	 * @return string
	 */
	public function getReminderEmail()
	{
	  return $this->email;
	}
		
}
