<?php namespace App\Jobs;

use App\Jobs\Command;
use App\Repositories\User\UserRepository;
use App\Realtime\Events as SocketClient;

use Auth;

class RemoveFriendCommand extends Command {


	/**
	 * @var UserRepository
	 */
	protected $currentUser;

    /**
     * @var UserRepository
     */
    protected $otherUser;

    /**
	 * @var Object
	 */
	protected $socketClient;


    /**
     * Create a new command instance.
     *
     * @param UserRepository $currentUser
     * @param UserRepository $otherUser
     *
     */
	public function __construct($currentUser, $otherUser)
	{
		$this->currentUser = $currentUser;

        $this->otherUser = $otherUser;

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

		$this->socketClient->updateChatListFriendRemoved($this->otherUser->id, 24, $this->currentUser->id, $this->otherUser->friends()->count());

		return true;

	}
}
