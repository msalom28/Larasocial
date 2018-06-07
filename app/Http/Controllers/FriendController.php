<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\User\UserRepository;
use App\Jobs\RemoveFriendCommand;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\FriendRequest;


class FriendController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(UserRepository $repository)
	{
        $user = Auth::user();

		$friends = $repository->findByIdWithFriends($user->id);

		return view('friends.index', compact('friends', 'user'));
	}

	/**
	 * Store a newly created friend
	 *
	 * @param Request $request
	 *
	 * @return Response
	 */
	public function store(Request $request, UserRepository $repository)
	{
		$validator = Validator::make($request->all(), ['userId' => 'required']);

        $currentUser = Auth::user();

		if($validator->fails())
		{			
			return response()->json(['response' => 'failed', 'message' => 'Something went wrong please try again.']);
		}
		else
		{
            $currentUser->createFriendShipWith($request->userId);

			$repository->findById($request->get('userId'))->createFriendShipWith($currentUser->id);

			FriendRequest::where('user_id', $currentUser->id)->where('requester_id', $request->userId)->delete();

			$friendRequestCount = $currentUser->friendRequests()->count();

			return response()->json(['response' => 'success', 'count' => $friendRequestCount, 'message' => 'Friend request accepted.']);
		}
		
	}


    /**
     * Terminate friendship between 2 users.
     *
     * @param Request $request
     *
     * @param UserRepository $userRepository
     *
     * @return Response
     */
	public function destroy(Request $request, UserRepository $userRepository)
	{
		$validator = Validator::make($request->all(), ['userId' => 'required']);

		if($validator->fails())
		{
			return response()->json(['response' => 'failed', 'message' => 'Something went wrong please try again.']);			
		}
		else
		{
            $otherUser = $userRepository->findById($request->get('userId'));

            $currentUser = Auth::user();

            $currentUser->finishFriendshipWith($request->get('userId'));

            $otherUser->finishFriendshipWith(Auth::user()->id);

		    $this->dispatch( new RemoveFriendCommand($currentUser, $otherUser) );

			$friendsCount = $currentUser->friends()->count();

			return response()->json(['response' => 'success', 'count' => $friendsCount, 'message' => 'This friend has been removed']);	
		}
	}

}
