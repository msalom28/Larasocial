<?php

use App\Http\Controllers\FeedController;
use Illuminate\Http\Request;
use Laracasts\TestDummy\Factory;
use App\Repositories\Feed\EloquentFeedRepository;
use App\User; 

class TestFeedController extends TestCase
{


	public function testIndexReturnsViewInstance()
	{
		$currentUser = Factory::create('App\User');

		$feeds = Factory::times(20)->create('App\Feed', ['user_id' => $currentUser->id]);

		Auth::login($currentUser);

		$feedController = new FeedController($currentUser);

		$feedRepository = new EloquentFeedRepository;

		$response = $feedController->index($feedRepository);

		$this->assertInstanceOf('Illuminate\View\View', $response);
	}

	public function testStoreReturnsJsonResponseInstance()
	{
		$currentUser = Factory::create('App\User');

		Auth::login($currentUser);

		$feedController = new FeedController($currentUser);

		$request = new Request(['body' => 'Hello my friend']);

		$response = $feedController->store($request);

		$this->assertInstanceOf('Illuminate\Http\JsonResponse', $response);
	}

}
