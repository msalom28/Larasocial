<?php 

use Laracasts\TestDummy\Factory;
use App\Events\FriendRequestWasSent;

class TestFriendRequestWasSent extends TestCase
{
	public function testBothUserObjectsExistInClass()
	{
		$requestedUser = Factory::create('App\User');

		$requesterUser = Factory::create('App\User');

		$event = new FriendRequestWasSent($requestedUser, $requesterUser);

		$this->assertEquals($requesterUser->email, $event->requesterUser->email);

		$this->assertEquals($requestedUser->email, $event->requestedUser->email);
	}

}