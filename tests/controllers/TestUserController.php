<?php

use Laracasts\TestDummy\Factory;
use App\Http\Controllers\UserController;
use App\Repositories\User\EloquentUserRepository;
use Illuminate\Http\Request;

class TestUserController extends testCase
{
	public function testIndexReturnsUserIndexViewOnSuccesfulRequest()
	{
		$currentUser = Factory::create('App\User');

		Auth::login($currentUser);

		$userController = new UserController($currentUser);

		$userRepository = new EloquentUserRepository;

		$request = new Request(['firstname' => '']);

		$response = $userController->index($request, $userRepository);

		$this->assertInstanceOf('Illuminate\View\View', $response);
	}
}