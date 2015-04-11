<?php namespace App\Handlers\Events;

use App\Events\UserWasRegistered;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;
use App\Mailers\UserMailer;

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
	public function __construct(UserMailer $mailer)
	{
		$this->mailer = $mailer;
	}

	/**
	 * Handle the event.
	 *
	 * @param  UserWasRegistered  $event
	 * @return void
	 */
	public function handle(UserWasRegistered $event)
	{
		return $this->mailer->sendWelcomeMessageTo($event->user);
	}

}
