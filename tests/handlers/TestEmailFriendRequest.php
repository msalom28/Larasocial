<?php 

use Laracasts\TestDummy\Factory;
use App\Events\FriendRequestWasSent;

class TestEmailFriendRequest extends TestCase
{
    use \Illuminate\Foundation\Testing\DatabaseTransactions;

    public function testHandleReturnsTrueAfterFriendRequestWasSent()
	{
		$requesterUser = factory(\App\User::class)->create();

		$requestedUser = factory(\App\User::class)->create();

		event(new FriendRequestWasSent($requestedUser, $requesterUser));
		
	}
}