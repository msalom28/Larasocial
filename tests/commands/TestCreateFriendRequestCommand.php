<?php 

use Laracasts\TestDummy\Factory;
use App\Commands\CreateFriendRequestCommand;
use App\Repositories\User\EloquentUserRepository;

class TestCreateFriendRequestCommand extends TestCase
{
	public function testHandleReturnsTrueOnSuccesfulFriendRequest()
	{
		$requestedUser = Factory::create('App\User');

		$requesterUser = Factory::create('App\User');

		$userRepository = new EloquentUserRepository;

		Auth::login($requesterUser);

		$command = new CreateFriendRequestCommand($requestedUser->id);

		$response = $command->handle($userRepository);

		$this->assertEquals(1, $requestedUser->friendRequests()->count());

		$this->assertTrue($response);


	}
} 