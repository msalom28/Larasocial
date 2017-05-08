<?php 

use Laracasts\TestDummy\Factory;

class FriendRequestTest extends BrowserKitTestCase
{
    use \Illuminate\Foundation\Testing\DatabaseTransactions;

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