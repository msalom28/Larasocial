<?php namespace App\Commands;

use App\Commands\Command;
use App\Repositories\User\UserRepository;
use App\Realtime\Events as SocketClient;
use Illuminate\Contracts\Bus\SelfHandling;
use Auth;

class RemoveFriendCommand extends Command implements SelfHandling {


	/**
	 * @var int
	 */
	protected $userId;

	/**
	 * @var Object
	 */
	protected $socketClient;


	/**
	 * Create a new command instance.
	 *
	 * @param User $user
	 *
	 * @return void
	 */
	public function __construct($userId)
	{
		$this->userId = $userId;

		$this->socketClient = new SocketClient;
	}

	/**
	 * Execute the command.
	 *
	 * @param FriendRepository $friendRepository
	 *
	 * @return void
	 */
	public function handle(UserRepository $userRepository)
	{
		$otherUser = $userRepository->findById($this->userId);

		$currentUser = Auth::user();

		$currentUser->finishFriendshipWith($this->userId);

		$otherUser->finishFriendshipWith(Auth::user()->id);

		$this->socketClient->updateChatListFriendRemoved($otherUser->id, 24, $currentUser->id, $otherUser->friends()->count());

		return true;

	}
}
