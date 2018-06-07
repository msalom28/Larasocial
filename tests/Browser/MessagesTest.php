<?php 

use Laracasts\TestDummy\Factory;
use App\User;
use App\Message;

class MessagesTest extends \Tests\DuskTestCase
{
   // use \Illuminate\Foundation\Testing\DatabaseTransactions;

    public function testSendingAmessageToAnotherUser()
	{
		$currentUser = factory(\App\User::class)->create();

		$otherUser = factory(\App\User::class)->create();

        $this->browse(function ($browser, $browser2) use ($currentUser, $otherUser) {
            $browser->loginAs($currentUser)
                ->visit('/messages/compose/'.$otherUser->id)
                ->type('body', 'This is the new message to you.')
                ->click('.message-form .btn');

            $browser2->loginAs($otherUser)
                ->visit('/messages/1')
                ->assertSee('This is the new message to you.');
        });

	}

    public function tearDown()
    {
        \Illuminate\Support\Facades\DB::table('users')->truncate();
        \Illuminate\Support\Facades\DB::table('messages')->truncate();
        \Illuminate\Support\Facades\DB::table('message_responses')->truncate();
        \Illuminate\Support\Facades\DB::table('message_user')->truncate();
        \Illuminate\Support\Facades\DB::table('message_response_user')->truncate();


    }
}