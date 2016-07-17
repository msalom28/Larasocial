<?php namespace App\Http\Controllers;

use App\Commands\RemoveFriendCommand;
use App\FriendRequest;
use App\Http\Requests;
use App\Repositories\User\UserRepository;
use Auth;
use Illuminate\Http\Request;
use Validator;


class FriendController extends Controller
{


    public function __construct()
    {
        $this->currentUser = Auth::user();
    }

    /**
     * Display a listing of the resource.
     *
     * @param UserRepository $repository
     *
     * @return Response
     */
    public function index(UserRepository $repository)
    {
        $user = $this->currentUser;

        $friends = $repository->findByIdWithFriends($user->id);

        return view('friends.index', compact('friends', 'user'));
    }

    /**
     * Store a newly created friend
     *
     * @param Request $request
     * @param UserRepository $repository
     *
     * @return Response
     */
    public function store(Request $request, UserRepository $repository)
    {
        $validator = Validator::make($request->all(), ['userId' => 'required']);

        if ($validator->fails()) {
            return response()->json(['response' => 'failed', 'message' => trans('messages.validation-failed')]);
        } else {
            $this->currentUser->createFriendShipWith($request->userId);

            $repository->findById($request->userId)->createFriendShipWith($this->currentUser->id);

            FriendRequest::where('user_id', $this->currentUser->id)->where('requester_id', $request->userId)->delete();

            $friendRequestCount = $this->currentUser->friendRequests()->count();

            return response()->json(['response' => 'success', 'count' => $friendRequestCount, 'message' => trans('messages.request-accepted')]);
        }
    }


    /**
     * Terminate friendship between 2 users.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function destroy(Request $request)
    {
        $validator = Validator::make($request->all(), ['userId' => 'required']);

        if ($validator->fails()) {
            return response()->json(['response' => 'failed', 'message' => trans('messages.validation-failed')]);
        } else {
            $this->dispatchFrom(RemoveFriendCommand::class, $request, ['userId' => $request->userId]);

            $friendsCount = $this->currentUser->friends()->count();

            return response()->json(['response' => 'success', 'count' => $friendsCount, 'message' => trans('messages.request-removed')]);
        }
    }
}
