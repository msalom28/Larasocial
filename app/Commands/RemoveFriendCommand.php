<?php namespace App\Commands;

use App\Realtime\Events as SocketClient;
use App\Repositories\User\UserRepository;
use Auth;
use Illuminate\Contracts\Bus\SelfHandling;

class RemoveFriendCommand extends Command implements SelfHandling
{
    /**
     * @var int
     */
    protected $userId;

    /**
     * @var Object
     */
    protected $socketClient;


    /**
     * Create a new command instance.
     *
     * @param $userId
     */
    public function __construct($userId)
    {
        $this->userId = $userId;

        $this->socketClient = new SocketClient;
    }

    /**
     * Execute the command.
     *
     * @param UserRepository $userRepository
     *
     * @return bool
     */
    public function handle(UserRepository $userRepository)
    {
        $otherUser = $userRepository->findById($this->userId);

        $currentUser = Auth::user();

        $currentUser->finishFriendshipWith($this->userId);

        $otherUser->finishFriendshipWith(Auth::user()->id);

        $this->socketClient->updateChatListFriendRemoved($otherUser->id, 24, $currentUser->id, $otherUser->friends()->count());

        return true;
    }
}
