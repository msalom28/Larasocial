<?php

use Laracasts\TestDummy\Factory;
use App\Repositories\User\EloquentUserRepository;
use App\Http\Controllers\MessageController; 

class TestMessageController extends TestCase
{
    use \Illuminate\Foundation\Testing\DatabaseTransactions;

    public function testCreateReturnsViewInstance()
	{
		$currentUser = factory(\App\User::class)->create();

		$otherUser = factory(\App\User::class)->create();

		$userRepository = New EloquentUserRepository;

		$messageController = new MessageController;

		Auth::login($currentUser);

		$response = $messageController->create($otherUser->id, $userRepository);

		$this->assertInstanceOf('Illuminate\View\View', $response);
	}
}