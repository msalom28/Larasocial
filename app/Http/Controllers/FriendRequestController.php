<?php namespace App\Http\Controllers;

use App\Commands\CreateFriendRequestCommand;
use App\FriendRequest;
use App\Http\Requests;
use App\Repositories\FriendRequest\FriendRequestRepository;
use App\Repositories\User\UserRepository;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Validator;


class FriendRequestController extends Controller
{

    /**
     * @var User
     */
    protected $currentUser;

    /**
     * Create a new instance of FriendRequestController.
     */
    public function __construct()
    {
        $this->middleware('auth');

        $this->currentUser = Auth::user();
    }

    /**
     * Display a listing of the resource.
     *
     * @param FriendRequestRepository $friendRequestRepository
     * @param UserRepository $userRepository
     *
     * @return Response
     */
    public function index(FriendRequestRepository $friendRequestRepository, UserRepository $userRepository)
    {
        $user = $this->currentUser;

        $requesterIds = $friendRequestRepository->getIdsThatSentRequestToCurrentUser($user->id);

        $userObjects = $userRepository->findManyById($requesterIds);

        $usersWhoRequested = new LengthAwarePaginator($userObjects, count($userObjects), 10, 1, ['path' => '/friend-requests']);

        return view('friend-requests.index', compact('user', 'usersWhoRequested'));
    }

    /**
     * Store a newly created Friend Request.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), ['userId' => 'required']);

        if ($validator->fails()) {
            return response()->json(['response' => 'failed', 'message' => trans('messages.validation-failed')]);
        } else {
            $this->dispatchFrom(CreateFriendRequestCommand::class, $request, ['requestedId' => $request->userId]);

            return response()->json(['response' => 'success', 'message' => trans('messages.request-submit-success')]);

        }
    }

    /**
     * Remove a friend request.
     *
     * @param Request $request
     *
     *
     * @return Response
     */
    public function destroy(Request $request)
    {
        $validator = Validator::make($request->all(), ['userId' => 'required']);

        if ($validator->fails()) {
            return response()->json(['response' => 'failed', 'message' => trans('messages.validation-failed')]);
        } else {
            FriendRequest::where('user_id', $this->currentUser->id)->where('requester_id', $request->userId)->delete();

            $friendRequestCount = $this->currentUser->friendRequests()->count();

            return response()->json(['response' => 'success', 'count' => $friendRequestCount, 'message' => trans('messages.request-remove-success')]);
        }
    }
}
