<?php 

use Laracasts\TestDummy\Factory;

class LoginSuccesful extends TestCase
{
	public function testLoginSuccesful()
	{
		$currentUser = Factory::create('App\User');  

		$this->visit('/')->submitForm('Sign in', ['email' => $currentUser->email, 'password' => $currentUser->password]);

	}
}