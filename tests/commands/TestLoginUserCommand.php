<?php

use App\Commands\LoginUserCommand;
use Laracasts\TestDummy\Factory; 

class TestLoginCommand extends TestCase
{
	public function testHandleReturnsTrueOnsuccesfulLogin()
	{
		$currentUser =  Factory::create('App\User');

		$loginUserCommand = new LoginUserCommand($currentUser->email, $currentUser->password);

		$loginUserCommand->handle();

		// $this->assertTrue($response);

		// $this->assertTrue($response);

		
	}


	public function testHandleReturnsFalseOnFailedLogin()
	{
		$loginUserCommand = new LoginUserCommand('wrong@email.com', 'wrongpassword');

		$response = $loginUserCommand->handle();

		$this->assertFalse(Auth::check());

		$this->assertFalse($response);
	}
}