<?php 

use Laracasts\TestDummy\Factory;
use App\Jobs\CreateFriendRequestCommand;
use App\Repositories\User\EloquentUserRepository;

class TestCreateFriendRequestCommand extends BrowserKitTestCase
{
    use \Illuminate\Foundation\Testing\DatabaseTransactions;


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