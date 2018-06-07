<?php

use Laracasts\TestDummy\Factory;
use App\Repositories\Feed\EloquentFeedRepository;
use App\User; 

class TestFeedRepository extends TestCase
{

    use \Illuminate\Foundation\Testing\DatabaseTransactions;

    public function testGetPublishedByUserAndFriendsReturnArrayWithResults()
	{

		$user = factory(\App\User::class)->create();

        $feeds = factory(\App\Feed::class,15)->create(['user_id' => $user->id]);

		$repository = new EloquentFeedRepository;

		$feedCount = $repository->getPublishedByUserAndFriends($user);

		$this->assertEquals(10, count($feedCount));

	}

	public function testGetPublishedByUserReturnArrayWithResults()
	{

        $user = factory(\App\User::class)->create();

        $feeds = factory(\App\Feed::class,15)->create(['user_id' => $user->id]);

        $repository = new EloquentFeedRepository;

		$feedCount = $repository->getPublishedByUser($user);

		$this->assertEquals(8, count($feedCount));

	}

	public function testGetPublishedByUserAndFriendsAjaxReturnArrayWithResults()
	{

        $user = factory(\App\User::class)->create();

        $feeds = factory(\App\Feed::class,15)->create(['user_id' => $user->id]);

		$repository = new EloquentFeedRepository;

		$feedCount = $repository->getPublishedByUserAndFriends($user);

		$this->assertEquals(10, count($feedCount));

	}

}