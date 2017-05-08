<?php 

use Laracasts\TestDummy\Factory;
use App\User;
use App\Http\Controllers\FriendController;
use App\Repositories\User\EloquentUserRepository;
use App\Repositories\User\UserRepository;
use Illuminate\Http\Request;

class TestFriendController extends TestCase
{
	use \Illuminate\Foundation\Testing\DatabaseTransactions;

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

		$response = $controller->destroy($request, app(UserRepository::class));

		$this->assertInstanceOf('Illuminate\Http\JsonResponse', $response);

	}

    public function testDestroyRemovesFriend()
    {
        $currentUser = Factory::create('App\User');

        $otherUser = Factory::create('App\User');

        $currentUser->createFriendShipWith($otherUser->id);

        $otherUser->createFriendShipWith($currentUser->id);

        Auth::login($currentUser);

        $request = new Request(['userId' => $otherUser->id]);

        $friendController = new FriendController($currentUser);

        $response = $friendController->destroy($request, app(UserRepository::class));

        $this->assertEquals(0, $currentUser->friends()->count());

        $this->assertInstanceOf('Illuminate\Http\JsonResponse', $response);
	}
}