<?php 

use Laracasts\TestDummy\Factory;
use App\Http\Controllers\FriendRequestController;
use Illuminate\Http\Request;

class TestFriendRequestController extends TestCase
{
	public function testStoreReturnsJsonReponseData()
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
}