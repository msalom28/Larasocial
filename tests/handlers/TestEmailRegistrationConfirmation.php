<?php 

use Laracasts\TestDummy\Factory;
use App\Events\UserWasRegistered;

class TestEmailRegistrationConfirmation extends TestCase
{
	public function testHandleReturnsTrueAfterUserWasRegistered()
	{
		$user = Factory::create('App\User');

		$response = event(new UserWasRegistered($user));

		$this->assertTrue($response[0]);

	}
}