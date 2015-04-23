<?php namespace App\Commands;

use App\Commands\Command;
use Auth;
use App\Realtime\Events as SocketClient;
use Illuminate\Contracts\Bus\SelfHandling;

class LoginUserCommand extends Command implements SelfHandling {
	/**
	 * @var string
	 */
	public $email;
	/**
	 * @var string
	 */
	public $password;

	/**
	 * @var Object
	 */
	public $socketClient;

	/**
	 * Create a new command instance.
	 *
	 * @param string $email
	 *
	 * @param string $password
	 *
	 * @return void
	 */
	public function __construct($email, $password)
	{
		$this->email = $email;

		$this->password = $password;

		$this->socketClient = new SocketClient;
	}
	/**
	 * Execute the command.
	 *
	 * @return void
	 */
	public function handle()
	{
		if(! Auth::attempt(['email' => $this->email, 'password' => $this->password])) return false;
		$user = Auth::user();
		$friendsUserIds = $user->friends()->where('onlinestatus', 1)->lists('requester_id');
		$relatedToId = $user->id;
 		$clientCode = 22;
 		$message = true;
		$this->socketClient->updateChatStatusBar($friendsUserIds, $clientCode, $relatedToId, $message);
		$user->updateOnlineStatus(1);
		
		return true;
	}
}
