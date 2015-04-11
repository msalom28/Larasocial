<?php namespace App\Mailers;

use Illuminate\Mail\Mailer as Mail;

abstract class Mailer
{
	/**
	 * @var Object
	 */
	public $mail;
	
	/**
	 * @param Object $mail
	 */
	public function __construct(Mail $mail)
	{	
		$this->mail = $mail;
	}
	/**
	 * @param Object $user
	 *
	 * @param string $subject
	 *
	 * @param string $view
	 *
	 * @param array $data
	 *
	 */
	public function sendTo($user, $subject, $view, $data = [])
	{
		$this->mail->queue($view, $data, function($message) use ($user, $subject)
		{
			$message->to($user->email)->subject($subject);
			
		});

		return true;
	}
}