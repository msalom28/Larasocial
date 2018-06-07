<?php 

use Laracasts\TestDummy\Factory;
use App\Jobs\CreateFriendRequestCommand;
use App\Repositories\User\EloquentUserRepository;

class TestCreateFriendRequestCommand extends TestCase
{
    use \Illuminate\Foundation\Testing\DatabaseTransactions;


    public function testHandleReturnsTrueOnSuccesfulFriendRequest()
	{
		$requestedUser = factory(\App\User::class)->create();

		$requesterUser = factory(\App\User::class)->create();

		$userRepository = new EloquentUserRepository;

		Auth::login($requesterUser);

		$command = new CreateFriendRequestCommand($requestedUser->id);

		$response = $command->handle($userRepository);

		$this->assertEquals(1, $requestedUser->friendRequests()->count());

		$this->assertTrue($response);


	}
}