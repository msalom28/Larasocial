<?php 

use Laracasts\TestDummy\Factory;
use App\User;
use App\Http\Controllers\FriendController;
use App\Repositories\User\EloquentUserRepository;
use Illuminate\Http\Request;

class TestFriendController extends TestCase
{
	public function testIndexReturnsViewInstance()
	{
		$users = Factory::times(5)->create('App\User');

		$currentUser = User::first();

		Auth::login($currentUser);

		$friendController = new FriendController($currentUser);

		$userRepository = new EloquentUserRepository;

		$response = $friendController->index($userRepository);

		$this->assertInstanceOf('Illuminate\View\View', $response);

	}

	public function testStoreReturnsJsonResponseInstance()
	{
		$users = Factory::times(5)->create('App\User');

		$currentUser = User::first();

		Auth::login($currentUser);

		$controller = new FriendController($currentUser);

		$repository = new EloquentUserRepository;

		$request = new Request(['userId' => 2]);

		$response = $controller->store($request, $repository);

		$this->assertInstanceOf('Illuminate\Http\JsonResponse', $response);

	}

	public function testDestroyReturnsJsonResponseInstance()
	{
		$users = Factory::times(5)->create('App\User');

		$currentUser = User::first();

		Auth::login($currentUser);

		$controller = new FriendController($currentUser);

		$request = new Request(['userId' => 2]);

		$response = $controller->destroy($request);

		$this->assertInstanceOf('Illuminate\Http\JsonResponse', $response);

	}
}