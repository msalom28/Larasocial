<?php namespace App\Jobs;

use App\Jobs\Command;
use App\Realtime\Events as SocketClient;
use App\User;
use Illuminate\Support\Facades\Auth;


class LogoutUserCommand extends Command {

	/**
	 * @var User
	 */
	public $user;

	/**
	 * @var Object
	 */
	public $socketClient;

	/**
	 * Create a new command instance.
	 *
	 * @param int $userId
	 *
	 * @return void
	 */
	public function __construct($userId)
	{
		$this->user = User::find($userId);

		$this->socketClient = new SocketClient;
	}

	/**
	 * Execute the command.
	 *
	 * @return void
	 */
	public function handle()
	{
		$this->user->updateOnlineStatus(0);

		$friendsUserIds = $this->user->friends()->where('onlinestatus', 1)->pluck('requester_id');

		$relatedToId = $this->user->id;

		$this->socketClient->updateChatStatusBar($friendsUserIds, 22, $relatedToId, false);

		Auth::logout();

	}

}
