<?php namespace App\Commands;

use App\Commands\Command;
use App\Repositories\User\UserRepository;
use App\Repositories\Message\MessageRepository;
use Illuminate\Contracts\Bus\SelfHandling;
use App\Message;
use App\MessageResponse;

class CreateMessageCommand extends Command implements SelfHandling {

	/**
	 * @var int
	 */
	public $receiverId;
	/**
	 * @var string
	 */
	public $body;
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
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct($receiverId, $body, $senderId, $senderProfileImage, $senderName)
	{
		$this->receiverId = $receiverId;
		$this->body = $body;
		$this->senderId = $senderId;
		$this->senderProfileImage = $senderProfileImage;
		$this->senderName = $senderName;
	}

	/**
	 * Execute the command.
	 *
	 * @param UserRepository $userRepository
	 *
	 * @param ResponseRepository $responseRepository
	 *
	 * @return void
	 */
	public function handle(UserRepository $userRepository, MessageRepository $messageRepository)
	{
		$message = Message::createMessage($this->body, $this->senderId, $this->senderProfileImage, $this->senderName);

		$response = MessageResponse::createMessageResponse(
			$this->body, 
			$this->senderId, 
			$this->receiverId, 
			$this->senderProfileImage, 
			$this->senderName
		);

		$userRepository->findById($this->receiverId)->messages()->save($message);

		$messageRepository->findById($message->id)->messageResponses()->save($response);
		
		$userRepository->findById($this->receiverId)->messageResponses()->save($response);

		return true;
	}

}
