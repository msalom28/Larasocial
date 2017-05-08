<?php namespace App\Jobs;

use App\Jobs\Command;
use App\User;
use Auth;
use App\Realtime\Events as SocketClient;


class LoginUserCommand extends Command {

    protected $user;
	/**
	 * @var Object
	 */
	public $socketClient;

    /**
     * Create a new command instance.
     *
     * @param User $user
     *
     */
	public function __construct(User $user)
	{
		$this->user = $user;

		$this->socketClient = new SocketClient;
	}
	/**
	 * Execute the command.
	 *
	 * @return void
	 */
	public function handle()
	{
		$user = $this->user;

		$friendsUserIds = $user->friends()->where('onlinestatus', 1)->pluck('requester_id');

		$relatedToId = $user->id;

 		$clientCode = 22;

 		$message = true;

		$this->socketClient->updateChatStatusBar($friendsUserIds, $clientCode, $relatedToId, $message);

		$user->updateOnlineStatus(1);

	}
}
