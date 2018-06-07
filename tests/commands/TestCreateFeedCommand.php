<?php

use App\Jobs\CreateFeedCommand;
use Laracasts\TestDummy\Factory;
use App\Feed;

class TestCreateFeedCommand extends TestCase
{

    use \Illuminate\Foundation\Testing\DatabaseTransactions;

    public function testHandleReturnsTheNewlyCreatedFeed()
	{
		$currentUser = factory(\App\User::class)->create();

		Auth::login($currentUser);

		$createFeedCommand = new CreateFeedCommand('This is the feed body', 'postername', 'http://image/sampleimage.jpg');

		$response = $createFeedCommand->handle();

		$this->assertInstanceOf('App\Feed', $response);
	}
}