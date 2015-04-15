<?php namespace App\Events;

use App\Events\Event;
use App\User;
use Illuminate\Queue\SerializesModels;

class FriendRequestWasSent extends Event {

	use SerializesModels;

	/**
	 * @var User
	 */
	public $requestedUser;

	/**
	 * @var User
	 */
	public $requesterUser;
	
	/**
	 * Create a new event instance.
	 *
	 * @param User $requestedUser
	 *
	 * @param User $requesterUser
	 *
	 * @return void
	 */
	public function __construct(User $requestedUser, User $requesterUser)
	{
		$this->requestedUser = $requestedUser;

		$this->requesterUser = $requesterUser;
	}

}
