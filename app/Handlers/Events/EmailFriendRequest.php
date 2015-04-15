<?php namespace App\Handlers\Events;

use App\Events\FriendRequestWasSent;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;
use App\Mailers\UserMailer;

class EmailFriendRequest
{

	/**
	 * @var UserMailer
	 */
	public $mailer;
	
	/**
	 * Create the event handler.
	 *
	 * @param UserMailer $mailer
	 *
	 * @return void
	 */
	public function __construct(UserMailer $mailer)
	{
		$this->mailer = $mailer;
	}
	/**
	 * Handle the event.
	 *
	 * @param FriendRequestWasSent $event
	 * @return void
	 */
	public function handle(FriendRequestWasSent $event)
	{		
		$this->mailer->sendFriendRequestAlertTo($event->requestedUser, $event->requesterUser);
	}


}
