<?php

use Laracasts\TestDummy\Factory; 

class PostFeedTest extends \Tests\DuskTestCase
{
   // use \Illuminate\Foundation\Testing\DatabaseTransactions;

	public function testSuccesfulPostFeed()
	{
        $currentUser = factory(\App\User::class)->create();

        $otherUser = factory(\App\User::class)->create();

        $this->browse(function ($browser) use ($currentUser) {
            $browser->loginAs($currentUser)
                ->visit('/feeds')
                ->type('body', 'New post')->press('Publish')
                ->waitForText('Just now')
                ->assertSee('New post');
        });

	}

    public function tearDown()
    {
        \Illuminate\Support\Facades\DB::table('users')->truncate();
        \Illuminate\Support\Facades\DB::table('feeds')->truncate();

    }
}