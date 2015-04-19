<?php namespace App\Commands;

use App\Commands\Command;
use App\Repositories\User\UserRepository;
use App\Events\FriendRequestWasSent;
use Illuminate\Contracts\Bus\SelfHandling;
use App\FriendRequest;
use Auth;

class CreateFriendRequestCommand extends Command implements SelfHandling {

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