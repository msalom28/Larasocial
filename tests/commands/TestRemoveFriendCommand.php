<?php 

use Laracasts\TestDummy\Factory;
use App\Commands\RemoveFriendCommand;
use App\Repositories\User\EloquentUserRepository;

class TestRemoveFriendCommand extends TestCase
{
	public function testHandleReturnsTrue()
	{
		$currentUser = Factory::create('App\User');

		$otherUser = Factory::create('App\User');

		$currentUser->createFriendShipWith($otherUser->id);

		$otherUser->createFriendShipWith($currentUser->id);

		$command = new RemoveFriendCommand($otherUser->id);

		$repository = New EloquentUserRepository;

		Auth::login($currentUser);

		$response = $command->handle($repository);

		$this->assertEquals(0, $currentUser->friends()->count());

		$this->assertTrue($response);

	}
}