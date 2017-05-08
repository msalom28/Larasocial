<?php

use App\Jobs\CreateFeedCommand;
use Laracasts\TestDummy\Factory;
use App\Feed;

class TestCreateFeedCommand extends BrowserKitTestCase
{

    use \Illuminate\Foundation\Testing\DatabaseTransactions;

    public function testHandleReturnsTheNewlyCreatedFeed()
	{
		$currentUser = Factory::create('App\User');

		Auth::login($currentUser);

		$createFeedCommand = new CreateFeedCommand('This is the feed body', 'postername', 'http://image/sampleimage.jpg');

		$response = $createFeedCommand->handle();

		$this->assertInstanceOf('App\Feed', $response);
	}
}