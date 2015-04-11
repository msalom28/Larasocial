<?php

use App\Commands\LoginUserCommand; 

class TestLoginCommand extends TestCase
{
	public function testHandleReturnsTrueOnsuccesfulLogin()
	{
		$currentUser =  Factory::create('App\User');

		$loginUserCommand = new LoginUserCommand($currentUser->email, $currentUser->password);

		$response = $loginUserCommand->handle();

		$this->assertTrue(Auth::check());

		$this->assertTrue($response);
	}


	public function testHandleReturnsTrueOnsuccesfulLogin()
	{
		$loginUserCommand = new LoginUserCommand('wrong@email.com', 'wrongpassword');

		$response = $loginUserCommand->handle();

		$this->assertFalse(Auth::check());

		$this->assertFalse($response);
	}
}