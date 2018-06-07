<?php

use Laracasts\TestDummy\Factory;
use App\Events\UserWasRegistered; 

class TestUserWasRegistered extends TestCase
{
    use \Illuminate\Foundation\Testing\DatabaseTransactions;

    public function testUserObjectExistinClass()
	{
		$user = factory(\App\User::class)->create();

		$event = new UserWasRegistered($user);

		$this->assertEquals($user->firstname, $event->user->firstname);
		
	}
}