<?php namespace App\Jobs;

use App\Jobs\Command;
use App\Realtime\Events as SocketClient;
use Illuminate\Support\Facades\Auth;

class UpdateChatStatusCommand extends Command {

	/**
	 * @var boolean
	 */
	protected $chatStatus;
	/**
	 * @var Object
	 */
	// protected $socketClient;
	/**
	 * @var Object
	 */
	protected $currentUser;

	/**
	 * @var Object
	 */
	protected $socketClient;

	
	/**
	 * Create a new command instance.
	 *
	 * @param boolean $chatStatus
	 *
	 * @return void
	 */
	public function __construct($chatStatus)
	{
		$this->chatStatus = $chatStatus;
		$this->socketClient = new SocketClient;
		$this->currentUser = Auth::user();
	}
	/**
	 * Execute the command.
	 *
	 * @return void
	 */
	public function handle()
	{
		$this->currentUser->updateChatStatus($this->chatStatus);

		$relatedToId = $this->currentUser->id;

		$friendsUserIds = $this->currentUser->friends()->where('onlinestatus', 1)->pluck('requester_id');

		$friendsUserIds[] = $relatedToId;

		$this->socketClient->updateChatStatusBar($friendsUserIds, 21, $relatedToId, $this->chatStatus);
	}

}
