<?php namespace App\Mailers;

use App\User;

class UserMailer extends Mailer
{
	/**
	 * Sending a welcome message to new User of Larasocial.
	 *
	 * @param User $user
	 *
	 */
	public function sendWelcomeMessageTo(User $user)
	{
		$subject = 'Welcome to Larasocial';

		$view = 'email-alerts.registration-confirm';

		$data = [];

		return $this->sendTo($user, $subject, $view);
	}


	// /**
	//  * Send alert to user when they have received a friend request.
	//  *
	//  * @param User $requestedUser
	//  *
	//  * @param User $requesterUser
	//  *
	//  */
	// public function sendFriendRequestAlertTo(User $requestedUser, User $requesterUser)
	// {
	// 	$subject = 'Someone would like to be your friend';
	// 	$view = 'emails.friend-request';
	// 	$data = ['userFirstname' => $requestedUser->firstname, 'requesterFirstname' => $requesterUser->firstname];
	// 	return $this->sendTo($requestedUser, $subject, $view, $data);
	// }	
}