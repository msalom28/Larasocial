<?php 

class FriendRequestTest extends \Tests\DuskTestCase
{

    public function testAddNewFriendRequest()
	{
		$currentUser = factory(\App\User::class)->create();

		$otherUser = factory(\App\User::class)->create();

        $this->browse(function ($browser) use ($currentUser) {
              $browser->loginAs($currentUser)
                ->visit('/users')
                ->clickLink('Add friend')
                ->waitForLink('Requested');
        });



	}

    public function tearDown()
    {
        DB::table('users')->truncate();
        DB::table('friend_requests')->truncate();
	}


}