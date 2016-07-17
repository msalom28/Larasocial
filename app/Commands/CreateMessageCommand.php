<?php namespace App\Commands;

use App\Message;
use App\MessageResponse;
use App\Repositories\Message\MessageRepository;
use App\Repositories\User\UserRepository;
use Illuminate\Contracts\Bus\SelfHandling;

class CreateMessageCommand extends Command implements SelfHandling
{
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
     * @param $receiverId
     * @param $body
     * @param $senderId
     * @param $senderProfileImage
     * @param $senderName
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
     * @param MessageRepository $messageRepository
     *
     * @return bool
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
