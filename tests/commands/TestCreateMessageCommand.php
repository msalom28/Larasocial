<?php

use App\Commands\CreateMessageCommand; 
use Laracasts\TestDummy\Factory;
use App\Repositories\User\EloquentUserRepository;
use App\Repositories\Message\EloquentMessageRepository;
use Faker\Factory as Faker;

class TestCreateMessageCommand extends TestCase
{
	public function testHandleReturnsTrue()
	{
		$faker = Faker::create();
		
		$user = Factory::create('App\User');

		$message = Factory::create('App\Message');

		$userRepository = new EloquentUserRepository;

		$messageRepository = new EloquentMessageRepository;

		$command = new CreateMessageCommand(
			$user->id, 
			$faker->sentence, 
			$faker->randomDigit, 
			$faker->imageUrl($width = 180, $height = 180),
			$faker->name
		);

		$response = $command->handle($userRepository, $messageRepository);

		$this->assertTrue($response);
	}
}