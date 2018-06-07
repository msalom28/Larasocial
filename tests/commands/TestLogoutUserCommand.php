<?php

use App\Jobs\LogoutUserCommand;
use Laracasts\TestDummy\Factory; 

class TestLogoutUserCommand extends TestCase
{
    use \Illuminate\Foundation\Testing\DatabaseTransactions;

    public function testHandleReturnsLogout()
	{
		$tempUser = factory(\App\User::class)->create();

		Auth::login($tempUser);

		$logoutUserCommand = new LogoutUserCommand($tempUser->id);

		$response = $logoutUserCommand->handle();

		$this->assertFalse(Auth::check());

	}

}