<?php 

use Laracasts\TestDummy\Factory;
use App\Events\FriendRequestWasSent;

class TestEmailFriendRequest extends TestCase
{
	public function testHandleReturnsTrueAfterFriendRequestWasSent()
	{
		$requesterUser = Factory::create('App\User');

		$requestedUser = Factory::create('App\User');

		event(new FriendRequestWasSent($requestedUser, $requesterUser));
		
	}
}