<?php namespace App\Listeners\Events;

use App\Events\FriendRequestWasSent;

use App\Mail\FriendRequest;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Mailers\UserMailer;
use Illuminate\Support\Facades\Mail;

class EmailFriendRequest
{


	/**
	 * Create the event handler.
	 *
	 * @return void
	 */
	public function __construct()
	{

	}
	/**
	 * Handle the event.
	 *
	 * @param FriendRequestWasSent $event
	 * @return void
	 */
	public function handle(FriendRequestWasSent $event)
	{		
        Mail::to($event->requestedUser)->send(new FriendRequest($event->requestedUser, $event->requesterUser));

    }


}
