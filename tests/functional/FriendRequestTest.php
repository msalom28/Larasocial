<?php 

use Laracasts\TestDummy\Factory;

class FriendRequestTest extends TestCase
{
	public function testAddNewFriendRequest()
	{
		$currentUser = Factory::create('App\User');

		$otherUser = Factory::create('App\User');

		Auth::login($currentUser);

		$this->visit('users')
		->click('Add friend');

		$this->assertResponseOk();
	}
}