<?php namespace App\Commands;

use App\Commands\Command;
use Auth;
use Illuminate\Contracts\Bus\SelfHandling;
use App\Realtime\Events as SocketClient;

class UpdateChatStatusCommand extends Command implements SelfHandling {

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
		$friendsUserIds = $this->currentUser->friends()->where('onlinestatus', 1)->lists('requester_id');
		$friendsUserIds[] = $relatedToId;
		$this->socketClient->updateChatStatusBar($friendsUserIds, 21, $relatedToId, $this->chatStatus);
	}

}
