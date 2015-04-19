<?php

use App\Commands\LogoutUserCommand;
use Laracasts\TestDummy\Factory; 

class TestLogoutUserCommand extends TestCase
{
	public function testHandleReturnsLogout()
	{
		$tempUser = Factory::create('App\User');

		Auth::login($tempUser);

		$logoutUserCommand = new LogoutUserCommand($tempUser->id);

		$response = $logoutUserCommand->handle();

		$this->assertFalse($response);

	}

}