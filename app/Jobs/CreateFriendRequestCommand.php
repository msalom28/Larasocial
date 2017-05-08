<?php namespace App\Jobs;

use App\Jobs\Command;
use App\Repositories\User\UserRepository;
use App\Events\FriendRequestWasSent;
use App\FriendRequest;
use Auth;

class CreateFriendRequestCommand extends Command {

	/**
	 *  @var int
	 */
	protected $requestedId;

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct($requestedId)
	{		
		$this->requestedId = $requestedId;
	}
	/**
	 * Execute the command.
	 *
	 * @param UserRepository $userRepository
	 *
	 * @return void
	 */
	public function handle(UserRepository $userRepository)
	{
		$requestedUser = $userRepository->findById($this->requestedId);

		$requesterUser = Auth::user();

		$friendRequest = FriendRequest::prepareFriendRequest($requesterUser->id);

		$requestedUser->friendRequests()->save($friendRequest);

		event(new FriendRequestWasSent($requestedUser, $requesterUser));

		return true;

	}
}