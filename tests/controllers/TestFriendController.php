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
        $users = factory(\App\User::class,5)->create();

		$currentUser = User::first();

		Auth::login($currentUser);

		$friendController = new FriendController($currentUser);

		$userRepository = new EloquentUserRepository;

		$response = $friendController->index($userRepository);

		$this->assertInstanceOf('Illuminate\View\View', $response);

	}

	public function testStoreReturnsJsonResponseInstance()
	{
        $users = factory(\App\User::class,5)->create();

		$currentUser = User::first();

		Auth::login($currentUser);

		$controller = new FriendController($currentUser);

		$repository = new EloquentUserRepository;

		$request = new Request(['userId' => $users->last()->id]);

		$response = $controller->store($request, $repository);

		$this->assertInstanceOf('Illuminate\Http\JsonResponse', $response);

	}

	public function testDestroyReturnsJsonResponseInstance()
	{
        $users = factory(\App\User::class,5)->create();

		$currentUser = User::first();

		Auth::login($currentUser);

		$controller = new FriendController();

		$request = new Request(['userId' => $users->last()->id]);

		$response = $controller->destroy($request, app(UserRepository::class));

		$this->assertInstanceOf('Illuminate\Http\JsonResponse', $response);

	}

    public function testDestroyRemovesFriend()
    {
        $currentUser = factory(\App\User::class)->create();

        $otherUser = factory(\App\User::class)->create();

        $currentUser->createFriendShipWith($otherUser->id);

        $otherUser->createFriendShipWith($currentUser->id);

        Auth::login($currentUser);

        $request = new Request(['userId' => $otherUser->id]);

        $friendController = new FriendController();

        $response = $friendController->destroy($request, app(UserRepository::class));

        $this->assertEquals(0, $currentUser->friends()->count());

        $this->assertInstanceOf('Illuminate\Http\JsonResponse', $response);
	}

}