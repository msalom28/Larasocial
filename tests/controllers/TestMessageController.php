<?php

use Laracasts\TestDummy\Factory;
use App\Repositories\User\EloquentUserRepository;
use App\Http\Controllers\MessageController; 

class TestMessageController extends TestCase
{
	public function testCreateReturnsViewInstance()
	{
		$currentUser = Factory::create('App\User');

		$otherUser = Factory::create('App\User');

		$userRepository = New EloquentUserRepository;

		$messageController = new MessageController;

		Auth::login($currentUser);

		$response = $messageController->create($otherUser->id, $userRepository);

		$this->assertInstanceOf('Illuminate\View\View', $response);
	}
}