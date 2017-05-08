<?php 

use Laracasts\TestDummy\Factory;
use App\Events\UserWasRegistered;

class TestEmailRegistrationConfirmation extends TestCase
{
    use \Illuminate\Foundation\Testing\DatabaseTransactions;

    public function testHandleReturnsTrueAfterUserWasRegistered()
	{
		$user = Factory::create('App\User');

		$response = event(new UserWasRegistered($user));

	}
}