<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;
use Illuminate\Http\Request;
use App\Jobs\CreateFriendRequestCommand;
use App\Repositories\FriendRequest\FriendRequestRepository;
use App\Repositories\User\UserRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use App\FriendRequest;
use Auth;


class FriendRequestController extends Controller {


	/**
	 * Create a new instance of FriendRequestController.
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(FriendRequestRepository $friendRequestRepository, UserRepository $userRepository)
	{
		$user = Auth::user();

		$requesterIds = $friendRequestRepository->getIdsThatSentRequestToCurrentUser($user->id);

		$userObjects = $userRepository->findManyById($requesterIds);

		$usersWhoRequested =  new LengthAwarePaginator($userObjects, count($userObjects), 10, 1, ['path' => '/friend-requests']);		

		return view('friend-requests.index', compact('user', 'usersWhoRequested'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
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

		if($validator->fails())
		{
			return response()->json(['response' => 'failed', 'message' => 'Something went wrong please try again.']);
		}
		else
		{
			$this->dispatch( new CreateFriendRequestCommand($request->userId) );
			
			return response()->json(['response' => 'success', 'message' => 'Friend request submitted']);

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

		$currentUser = Auth::user();

		if($validator->fails())
		{
			return response()->json(['response' => 'failed', 'message' => 'Something went wrong please try again.']);
		}
		else
		{
			FriendRequest::where('user_id', $currentUser->id)->where('requester_id', $request->userId)->delete();

			$friendRequestCount = $currentUser->friendRequests()->count();

			return response()->json(['response' => 'success', 'count' => $friendRequestCount, 'message' => 'friend request removed']);
		}
		
	}




}
