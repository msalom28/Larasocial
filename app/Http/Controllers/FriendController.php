<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;
use App\Repositories\User\UserRepository;
use App\Commands\RemoveFriendCommand;
use Validator;
use App\FriendRequest;


class FriendController extends Controller {


	public function __construct()
	{
		$this->currentUser = Auth::user();
	}

	/**
	 * Display a listing of the resource.
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
	 *
	 * @return Response
	 */
	public function store(Request $request, UserRepository $repository)
	{
		$validator = Validator::make($request->all(), ['userId' => 'required']);

		if($validator->fails())
		{			
			return response()->json(['response' => 'failed', 'message' => 'Something went wrong please try again.']);
		}
		else
		{
			$this->currentUser->createFriendShipWith($request->userId);

			$repository->findById($request->userId)->createFriendShipWith($this->currentUser->id);

			FriendRequest::where('user_id', $this->currentUser->id)->where('requester_id', $request->userId)->delete();

			$friendRequestCount = $this->currentUser->friendRequests()->count();

			return response()->json(['response' => 'success', 'count' => $friendRequestCount, 'message' => 'Friend request accepted.']);
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

		if($validator->fails())
		{
			return response()->json(['response' => 'failed', 'message' => 'Something went wrong please try again.']);			
		}
		else
		{
			$this->dispatchFrom(RemoveFriendCommand::class, $request, ['userId' => $request->userId]);

			$friendsCount = $this->currentUser->friends()->count();

			return response()->json(['response' => 'success', 'count' => $friendsCount, 'message' => 'This friend has been removed']);	
		}
	}

}
