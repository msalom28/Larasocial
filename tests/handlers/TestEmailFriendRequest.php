<?php 

use Laracasts\TestDummy\Factory;
use App\Events\FriendRequestWasSent;

class TestEmailFriendRequest extends TestCase
{
    use \Illuminate\Foundation\Testing\DatabaseTransactions;

    public function testHandleReturnsTrueAfterFriendRequestWasSent()
	{
		$requesterUser = Factory::create('App\User');

		$requestedUser = Factory::create('App\User');

		event(new FriendRequestWasSent($requestedUser, $requesterUser));
		
	}
}