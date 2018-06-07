<?php 

use Laracasts\TestDummy\Factory;
use App\Http\Controllers\FriendRequestController;
use App\Repositories\FriendRequest\EloquentFriendRequestRepository;
use App\Repositories\User\EloquentUserRepository;
use Illuminate\Http\Request;

class TestFriendRequestController extends TestCase
{
	use \Illuminate\Foundation\Testing\DatabaseTransactions;

    public function testStoreReturnsJsonReponseInstance()
	{
		$currentUser = factory(\App\User::class)->create();

		$otherUser = factory(\App\User::class)->create();

		Auth::login($currentUser);

		$request = new Request(['userId' => $otherUser->id]);

		$friendRequestController = new FriendRequestController($currentUser);

		$response = $friendRequestController->store($request);

		$this->assertEquals(1, $otherUser->friendRequests()->count());

		$this->assertInstanceOf('Illuminate\Http\JsonResponse', $response);

	}

	public function testIndexReturnsViewInstance()
	{
		$user = factory(\App\User::class)->create();

        $friendRequests = factory(\App\FriendRequest::class,25)->create(['user_id' => $user->id]);

		Auth::login($user);

		$friendRequestController = new FriendRequestController($user);

		$friendRequestRepository = new EloquentFriendRequestRepository;

		$userRepository = new EloquentUserRepository;

		$response = $friendRequestController->index($friendRequestRepository, $userRepository);

		$this->assertInstanceOf('Illuminate\View\View', $response);

	}
}