<?php

use App\Repositories\Message\EloquentMessageRepository;
use Laracasts\TestDummy\Factory;
use App\Message;

class TestMessageRepository extends TestCase
{
	public function testFindByidReTurnsMessageInstance()
	{
		$messageRepository = new EloquentMessageRepository;

		$message = Factory::create('App\Message');

		$response = $messageRepository->findById($message->id);

		$this->assertInstanceOf('App\Message', $response);

	}

	public function testFindByIdWithResponsesReturnsCollection()
	{
		$messageResponse = Factory::create('App\MessageResponse');

		$message = Message::first(); 

		$messageRepository = new EloquentMessageRepository;

		$response = $messageRepository->findByIdWithMessageResponses($message->id);

		$this->assertInstanceOf('App\Message', $response);


	}
}