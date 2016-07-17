<?php namespace App\Commands;

use App\Events\FriendRequestWasSent;
use App\FriendRequest;
use App\Repositories\User\UserRepository;
use Auth;
use Illuminate\Contracts\Bus\SelfHandling;

class CreateFriendRequestCommand extends Command implements SelfHandling
{

    /**
     * @var int
     */
    protected $requestedId;

    /**
     * Create a new command instance.
     *
     * @param $requestedId
     */
    public function __construct($requestedId)
    {
        $this->requestedId = $requestedId;
    }

    /**
     * Execute the command.
     *
     * @param UserRepository $userRepository
     *
     * @return boolean
     */
    public function handle(UserRepository $userRepository)
    {
        $requestedUser = $userRepository->findById($this->requestedId);

        $requesterUser = Auth::user();

        $friendRequest = FriendRequest::prepareFriendRequest($requesterUser->id);

        $requestedUser->friendRequests()->save($friendRequest);

        event(new FriendRequestWasSent($requestedUser, $requesterUser));

        return true;
    }
}
