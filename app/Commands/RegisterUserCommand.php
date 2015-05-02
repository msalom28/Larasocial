<?php namespace App\Commands;

use App\Events\UserWasRegistered;
use App\Commands\Command;
use Illuminate\Contracts\Bus\SelfHandling;
use App\User;
use Auth;

class RegisterUserCommand extends Command implements SelfHandling {
	
	protected $firstname;
	protected $lastname;
	protected $email;
	protected $password;
	protected $password_confirmation;
	protected $gender;
	protected $month;
	protected $day;
	protected $year;
	protected $profileimage;
	protected $profileImagePath;
	protected $birthday;		
	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct(
		$firstname,
		$lastname,
		$email,
		$password,
		$password_confirmation,
		$gender,
		$month,
		$day,
		$year,
		$profileimage,
		$profileImagePath,
		$birthday
	)
	{
	
		$this->firstname = $firstname;
		$this->lastname = $lastname;
		$this->email = $email;
		$this->password = $password;
		$this->password_confirmation = $password_confirmation;
		$this->gender = $gender;
		$this->month = $month;
		$this->day = $day;
		$this->year = $year;
		$this->profileimage = $profileimage;
		$this->profileImagePath = $profileImagePath;
		$this->birthday = $birthday; 
	}
	/**
	 * Handle the request
	 * @param UserRepository $userRepository
	 * 
	 * return void
	 */
	public function handle()
	{
		$user = User::register(
			$this->firstname, 
			$this->lastname, 
			$this->email,
			bcrypt($this->password), 
			$this->gender, 
			$this->birthday, 
			$this->profileImagePath
		);
		
		$user->save();

		event(new UserWasRegistered($user));

		Auth::login($user);

		$user->updateOnlineStatus(1);

		return $user;
	}
}