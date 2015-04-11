<?php

use Laracasts\TestDummy\Factory;
use App\Events\UserWasRegistered; 

class TestUserWasRegistered extends TestCase
{
	public function testUserWasRegisteredClassContainsUserObject()
	{
		$user = Factory::create('App\User');

		$event = new UserWasRegistered($user);

		$this->assertEquals($user->firstname, $event->user->firstname);
		
	}
}