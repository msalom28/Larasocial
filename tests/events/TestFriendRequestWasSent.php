<?php 

use Laracasts\TestDummy\Factory;
use App\Events\FriendRequestWasSent;

class TestFriendRequestWasSent extends TestCase
{
    use \Illuminate\Foundation\Testing\DatabaseTransactions;

    public function testBothUserObjectsExistInClass()
	{
		$requestedUser = factory(\App\User::class)->create();

		$requesterUser = factory(\App\User::class)->create();

		$event = new FriendRequestWasSent($requestedUser, $requesterUser);

		$this->assertEquals($requesterUser->email, $event->requesterUser->email);

		$this->assertEquals($requestedUser->email, $event->requestedUser->email);
	}

}