<?php namespace App\Jobs;

use App\Jobs\Command;
use App\Feed;
use Auth;

class CreateFeedCommand extends Command {

	/**
	 * @var string
	 */
	protected $body;
	/**
	 * @var string
	 */
	protected $posterFirstname;
	/**
	 * @var string
	 */
	protected $posterProfileImage;
	/**
	 * Create a new command instance.
	 *
	 *	
	 * @param string $body
	 *
	 * @param string $posterFirstname
	 *	
	 * @param string $posterProfileImage
	 *
	 * @return void
	 */
	public function __construct($body, $posterFirstname, $posterProfileImage)
	{
		$this->body = $body;
		$this->posterFirstname = $posterFirstname;
		$this->posterProfileImage = $posterProfileImage;
	}

	/**
	 * Execute the command.
	 *
	 * @param  FeedRepository $feedRepository
	 *
	 * @return void
	 */
	public function handle()
	{
		$feed = Feed::publish($this->body, $this->posterFirstname, $this->posterProfileImage);

		Auth::user()->feeds()->save($feed);

		return $feed;
	}
}
