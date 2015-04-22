<?php namespace App\Commands;

use App\Commands\Command;
use Illuminate\Contracts\Bus\SelfHandling;
use App\Repositories\User\UserRepository;
use App\Repositories\Message\MessageRepository;
use App\MessageResponse;

class CreateMessageResponseCommand extends Command implements SelfHandling {
	/**
	 * @var int
	 */
	public $receiverId;
	/**
	 * @var string
	 */
	public $emailbody;
	/**
	 * @var int
	 */
	public $senderId;
	/**
	 * @var string
	 */
	public $senderProfileImage;
	/**
	 * @var string
	 */
	public $senderName;
	/**
	 * @var int
	 */
	public $emailId;
	/**
	 * @var Object
	 */
	public $currentUser;


	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct($receiverId, $body, $senderId, $senderProfileImage, $senderName, $messageId, $currentUser)
	{
		$this->receiverId = $receiverId;
		$this->body = $body;
		$this->senderId = $senderId;
		$this->senderProfileImage = $senderProfileImage;
		$this->senderName = $senderName;
		$this->messageId = $messageId;
		$this->currentUser = $currentUser;
	}

	/**
	 * Execute the command.
	 *
	 * @param UserRepository, $userRepository
	 *
	 * @param EmailRepository $emailRepository
	 *
	 * @return void
	 */
	public function handle(UserRepository $userRepository, MessageRepository $messageRepository)
	{	
		$user = $userRepository->findById($this->receiverId);

		$message = $messageRepository->findById($this->messageId);		

		if(! $message->belongsToUser($this->receiverId)) $user->messages()->save($message);

		if($this->receiverId == $this->senderId)
		{
			$userIdToSaveTo = $message->getLastReceiverId();

			$messageResponse = MessageResponse::createMessageResponse(
				$this->body, 
				$this->senderId, 
				$userIdToSaveTo, 
				$this->senderProfileImage, 
				$this->senderName
			);

			$messageRepository->findById($this->messageId)->messageResponses()->save($messageResponse);

			$userRepository->findById($userIdToSaveTo)->messageResponses()->save($messageResponse);
		}
		else
		{
			$messageResponse = MessageResponse::createMessageResponse(
				$this->body, 
				$this->senderId, 
				$this->receiverId, 
				$this->senderProfileImage, 
				$this->senderName
			);

			$messageRepository->findById($this->messageId)->messageResponses()->save($messageResponse);

			$user->messageResponses()->save($messageResponse);
		}
		
	}

}
