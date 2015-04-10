<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

	use Authenticatable, CanResetPassword;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['firstname', 'lastname', 'email', 'password', 'gender', 'birthday', 'profileimage'];
	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];


	/**
	 * Register a new Larasocial user.
	 *
	 * @param string $firstname
	 *
	 * @param string $lastname
	 *
	 * @param string $email
	 *
	 * @param string $password
	 *
	 * @param string $gender
	 *
	 * @param string $birthday
	 *
	 * @param string $profileimage
	 *
	 * @return User $user
	 */
	public static function register($firstname, $lastname, $email, $password, $gender, $birthday, $profileimage)
	{
		$user = new static(compact('firstname', 'lastname', 'email', 'password', 'gender', 'birthday', 'profileimage'));

		return $user;
	}

}
