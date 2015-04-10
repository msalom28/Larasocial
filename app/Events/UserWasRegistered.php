<?php namespace App\Events;

use App\Events\Event;
use App\User;

use Illuminate\Queue\SerializesModels;

class UserWasRegistered extends Event {

	use SerializesModels;

	/**
	 * @var Object
	 */
	public $user;

	/**
	 * Create a new event instance.
	 *
	 * @param Object $user
	 *
	 * @return void
	 */
	public function __construct(User $user)
	{
		$this->user = $user;
	}
}
