<?php

use Laracasts\TestDummy\Factory;
use App\Http\Controllers\UserController;
use App\Repositories\User\EloquentUserRepository;
use App\Repositories\Feed\EloquentFeedRepository;
use Illuminate\Http\Request;

class TestUserController extends testCase
{
	public function testIndexReturnsViewInstance()
	{
		$currentUser = Factory::create('App\User');

		Auth::login($currentUser);

		$userController = new UserController($currentUser);

		$userRepository = new EloquentUserRepository;

		$request = new Request(['firstname' => '']);

		$response = $userController->index($request, $userRepository);

		$this->assertInstanceOf('Illuminate\View\View', $response);
	}

	public function testShowReturnsViewInstance()
	{
		$currentUser = Factory::create('App\User');

		$otherUser = Factory::create('App\User');

		$feeds = Factory::times(15)->create('App\Feed', ['user_id' => $otherUser->id]);

		Auth::login($currentUser);

		$userController = new UserController($currentUser);

		$userRepository = new EloquentUserRepository;

		$feedRepository = new EloquentFeedRepository;

		$response = $userController->show($otherUser->id, $userRepository, $feedRepository);

		$this->assertInstanceOf('Illuminate\View\View', $response);

	}
}