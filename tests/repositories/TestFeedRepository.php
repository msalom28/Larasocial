<?php

use Laracasts\TestDummy\Factory;
use App\Repositories\Feed\EloquentFeedRepository;
use App\User; 

class TestFeedRepository extends TestCase
{

	public function testGetPublishedByUserAndFriendsReturnArrayWithResults()
	{

		$user = Factory::create('App\User');

		$feeds = Factory::times(20)->create('App\Feed', ['user_id' => $user->id]);

		$repository = new EloquentFeedRepository;

		$feedCount = $repository->getPublishedByUserAndFriends($user);

		$this->assertEquals(10, count($feedCount));

	}

	public function testGetPublishedByUserReturnArrayWithResults()
	{

		$user = Factory::create('App\User');

		$feeds = Factory::times(20)->create('App\Feed', ['user_id' => $user->id]);

		$repository = new EloquentFeedRepository;

		$feedCount = $repository->getPublishedByUser($user);

		$this->assertEquals(8, count($feedCount));

	}

	public function testGetPublishedByUserAndFriendsAjaxReturnArrayWithResults()
	{

		$user = Factory::create('App\User');

		$feeds = Factory::times(20)->create('App\Feed', ['user_id' => $user->id]);

		$repository = new EloquentFeedRepository;

		$feedCount = $repository->getPublishedByUserAndFriends($user);

		$this->assertEquals(10, count($feedCount));

	}

}