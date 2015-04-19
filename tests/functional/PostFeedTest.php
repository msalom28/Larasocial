<?php

use Laracasts\TestDummy\Factory; 

class PostFeedTest extends TestCase
{
	public function testSuccesfulPostFeed()
	{
		$currentUser = Factory::create('App\User');

		Auth::login($currentUser);

		 $this->visit('feeds')->submitForm('Publish', ['body' => 'New post']);

		 $feedCount =  $currentUser->feeds()->count();

		 $this->assertEquals(1, $feedCount);
	}
}