<?php

use Laracasts\TestDummy\Factory;
use App\Http\Controllers\UserController;
use App\Repositories\User\EloquentUserRepository;
use App\Repositories\Feed\EloquentFeedRepository;
use Illuminate\Http\Request;

class TestUserController extends testCase
{
    use \Illuminate\Foundation\Testing\DatabaseTransactions;

    public function testIndexReturnsViewInstance()
	{
		$currentUser = factory(\App\User::class)->create();

		Auth::login($currentUser);

		$userController = new UserController($currentUser);

		$userRepository = new EloquentUserRepository;

		$request = new Request(['firstname' => '']);

		$response = $userController->index($request, $userRepository);

		$this->assertInstanceOf('Illuminate\View\View', $response);
	}

	public function testShowReturnsViewInstance()
	{
		$currentUser = factory(\App\User::class)->create();

		$otherUser = factory(\App\User::class)->create();

        $feeds = factory(\App\Feed::class,15)->create(['user_id' => $otherUser->id]);

		Auth::login($currentUser);

		$userController = new UserController($currentUser);

		$userRepository = new EloquentUserRepository;

		$feedRepository = new EloquentFeedRepository;

		$response = $userController->show($otherUser->id, $userRepository, $feedRepository);

		$this->assertInstanceOf('Illuminate\View\View', $response);

	}
}