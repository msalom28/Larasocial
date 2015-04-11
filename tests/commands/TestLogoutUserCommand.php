<?php

use App\Commands\LogoutUserCommand; 

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