<?php 

use Laracasts\TestDummy\Factory;
use App\Http\Controllers\FriendRequestController;
use App\Repositories\FriendRequest\EloquentFriendRequestRepository;
use App\Repositories\User\EloquentUserRepository;
use Illuminate\Http\Request;

class TestFriendRequestController extends TestCase
{
	public function testStoreReturnsJsonReponseInstance()
	{
		$currentUser = Factory::create('App\User');

		$otherUser = Factory::create('App\User');

		Auth::login($currentUser);

		$request = new Request(['userId' => $otherUser->id]);

		$friendRequestController = new FriendRequestController($currentUser);

		$response = $friendRequestController->store($request);

		$this->assertEquals(1, $otherUser->friendRequests()->count());

		$this->assertInstanceOf('Illuminate\Http\JsonResponse', $response);

	}

	public function testIndexReturnsViewInstance()
	{
		$user = Factory::create('App\User');

		$friendRequests = Factory::times(25)->create('App\FriendRequest', ['user_id' => $user->id]);		

		Auth::login($user);

		$friendRequestController = new FriendRequestController($user);

		$friendRequestRepository = new EloquentFriendRequestRepository;

		$userRepository = new EloquentUserRepository;

		$response = $friendRequestController->index($friendRequestRepository, $userRepository);

		$this->assertInstanceOf('Illuminate\View\View', $response);

	}
}