<?php 

use Laracasts\TestDummy\Factory;
use App\User;
use App\Message;

class MessagesTest extends BrowserKitTestCase
{
    use \Illuminate\Foundation\Testing\DatabaseTransactions;

    public function testSendingAmessageToAnotherUser()
	{
		$currentUser = Factory::create('App\User');

		$otherUser = Factory::create('App\User');

		Auth::login($currentUser);

		$this->visit('/messages/compose/'.$otherUser->id)
		->submitForm('Submit', ['body' => 'This is the new message to you.'])
		->seeInDatabase('messages', ['body' => 'This is the new message to you.'])
		->seeInDatabase('message_responses', ['body' => 'This is the new message to you.']);
	}

	
}