<?php

use Laracasts\TestDummy\Factory;
use App\Repositories\FriendRequest\EloquentFriendRequestRepository;
use App\User; 

class TestFriendRequestRepository extends TestCase
{

	public function testGetIdsThatSentRequestToCurrentUser()
	{
		$user = Factory::create('App\User');

		$friendRequests = Factory::times(25)->create('App\FriendRequest', ['user_id' => $user->id]);

		$repository = new EloquentFriendRequestRepository();

		$results = $repository->getIdsThatSentRequestToCurrentUser($user->id);

		$this->assertEquals(25, count($results));
	}
}



