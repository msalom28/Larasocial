<?php 

use Laracasts\TestDummy\Factory;
use App\Jobs\RemoveFriendCommand;
use App\Repositories\User\EloquentUserRepository;

class TestRemoveFriendCommand extends BrowserKitTestCase
{
    use \Illuminate\Foundation\Testing\DatabaseTransactions;

    public function testHandleReturnsTrue()
	{
		$currentUser = Factory::create('App\User');

		$otherUser = Factory::create('App\User');

		$currentUser->createFriendShipWith($otherUser->id);

		$otherUser->createFriendShipWith($currentUser->id);

		$command = new RemoveFriendCommand($currentUser, $otherUser);

		$repository = New EloquentUserRepository;

		$response = $command->handle($repository);

		$this->assertTrue($response);

	}
}