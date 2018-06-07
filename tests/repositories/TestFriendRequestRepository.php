<?php

use Laracasts\TestDummy\Factory;
use App\Repositories\FriendRequest\EloquentFriendRequestRepository;
use App\User; 

class TestFriendRequestRepository extends TestCase
{

    use \Illuminate\Foundation\Testing\DatabaseTransactions;

	public function testGetIdsThatSentRequestToCurrentUser()
	{
		$user = factory(\App\User::class)->create();

        $friendRequests = factory(\App\FriendRequest::class,25)->create(['user_id' => $user->id]);

        $repository = new EloquentFriendRequestRepository();

		$results = $repository->getIdsThatSentRequestToCurrentUser($user->id);

		$this->assertEquals(25, count($results));
	}
}



