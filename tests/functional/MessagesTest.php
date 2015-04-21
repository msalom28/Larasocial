<?php 

use Laracasts\TestDummy\Factory;
use App\User;

class MessagesTest extends TestCase
{
	public function testSendingAmessageToAnotherUser()
	{
		$currentUser = Factory::create('App\User');

		$otherUser = Factory::create('App\User');

		Auth::login($currentUser);

		$this->visit('/messages/compose/'.$otherUser->id)
		->submitForm('Submit', ['body' => 'This is the new message to you.'])
		->verifyInDatabase('messages', ['body' => 'This is the new message to you.'])
		->verifyInDatabase('message_responses', ['body' => 'This is the new message to you.']);		
	}

	public function testViewingMessagesThatBelongToAUser()
	{
		$user = Factory::create('App\User');

		$messages = Factory::times(10)->create('App\Message');

		foreach ($messages as $message) {
			
			$user->messages()->save($message);
		}

		Auth::login($user);

		$this->visit('messages')->andSee('Messages');
	}

	
}