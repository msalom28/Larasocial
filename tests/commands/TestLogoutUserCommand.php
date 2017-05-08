<?php

use App\Jobs\LogoutUserCommand;
use Laracasts\TestDummy\Factory; 

class TestLogoutUserCommand extends BrowserKitTestCase
{
    use \Illuminate\Foundation\Testing\DatabaseTransactions;

    public function testHandleReturnsLogout()
	{
		$tempUser = Factory::create('App\User');

		Auth::login($tempUser);

		$logoutUserCommand = new LogoutUserCommand($tempUser->id);

		$response = $logoutUserCommand->handle();

		$this->assertFalse(Auth::check());

	}

}