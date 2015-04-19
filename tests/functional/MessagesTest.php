<?php 

use Laracasts\TestDummy\Factory;

class MessagesTest extends TestCase
{
	public function testSendingAmessageToAnotherUser()
	{
		$currentUser = Factory::create('App\User');

		$otherUser = Factory::create('App\User');

		$this->visit('/messages/compose/'.$otherUser->id)
		->submitForm('Send message', ['body' => 'This is the new message to you.']);

		$this->assertCount(1, $otherUser->messages()->count());

		$this->asserResponseOk();
		
	}

	
}