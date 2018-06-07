<?php

use App\Repositories\Message\EloquentMessageRepository;
use Laracasts\TestDummy\Factory;
use App\Message;

class TestMessageRepository extends TestCase
{
    use \Illuminate\Foundation\Testing\DatabaseTransactions;

    public function testFindByidReTurnsMessageInstance()
	{
		$messageRepository = new EloquentMessageRepository;

        $message = factory(\App\Message::class)->create();

		$response = $messageRepository->findById($message->id);

		$this->assertInstanceOf(Message::class, $response);

	}

	public function testFindByIdWithResponsesReturnsCollection()
	{
        $messageResponse = factory(\App\MessageResponse::class)->create();

		$message = Message::first(); 

		$messageRepository = new EloquentMessageRepository;

		$response = $messageRepository->findByIdWithMessageResponses($message->id);

		$this->assertInstanceOf('App\Message', $response);


	}
}