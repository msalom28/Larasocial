<?php 

use Laracasts\TestDummy\Factory;
use App\Jobs\RemoveFriendCommand;
use App\Repositories\User\EloquentUserRepository;

class TestRemoveFriendCommand extends TestCase
{
    use \Illuminate\Foundation\Testing\DatabaseTransactions;

    public function testHandleReturnsTrue()
	{
		$currentUser = factory(\App\User::class)->create();

		$otherUser = factory(\App\User::class)->create();

		$currentUser->createFriendShipWith($otherUser->id);

		$otherUser->createFriendShipWith($currentUser->id);

		$command = new RemoveFriendCommand($currentUser, $otherUser);

		$repository = New EloquentUserRepository;

		$response = $command->handle($repository);

		$this->assertTrue($response);

	}
}