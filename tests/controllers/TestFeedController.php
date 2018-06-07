<?php

use App\Http\Controllers\FeedController;
use Illuminate\Http\Request;
use Laracasts\TestDummy\Factory;
use App\Repositories\Feed\EloquentFeedRepository;
use App\User; 

class TestFeedController extends TestCase
{
    use \Illuminate\Foundation\Testing\DatabaseTransactions;

	public function testIndexReturnsViewInstance()
	{
		$currentUser = factory(\App\User::class)->create();

        $feeds = factory(\App\Feed::class,20)->create(['user_id' => $currentUser->id]);

		Auth::login($currentUser);

		$feedController = new FeedController($currentUser);

		$feedRepository = new EloquentFeedRepository;

		$response = $feedController->index($feedRepository);

		$this->assertInstanceOf('Illuminate\View\View', $response);
	}

	public function testStoreReturnsJsonResponseInstance()
	{
		$currentUser = factory(\App\User::class)->create();

		Auth::login($currentUser);

		$feedController = new FeedController($currentUser);

		$request = new Request(['body' => 'Hello my friend']);

		$response = $feedController->store($request);

		$this->assertInstanceOf('Illuminate\Http\JsonResponse', $response);
	}

}
