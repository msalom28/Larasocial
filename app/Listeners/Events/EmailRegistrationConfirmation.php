<?php namespace App\Listeners\Events;

use App\Events\UserWasRegistered;

use App\Mail\Welcome;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class EmailRegistrationConfirmation {

	/**
	 * @var Object
	 */
	public $mailer;
	
	/**
	 * Create the event handler.
	 *
	 * @param UserMailer $mailer
	 *
	 * @return void
	 */
	public function __construct()
	{

	}

	/**
	 * Handle the event.
	 *
	 * @param  UserWasRegistered  $event
	 * @return void
	 */
	public function handle(UserWasRegistered $event)
	{
        Mail::to($event->user)->send(new Welcome());
	}

}
