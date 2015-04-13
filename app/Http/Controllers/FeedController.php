<?php namespace App\Http\Controllers;

use App\Commands\CreateFeedCommand;
use App\Http\Controllers\Controller;
use App\Repositories\Feed\FeedRepository;
use Auth;
use Illuminate\Http\Request;
use Validator;
use App\Feed;

class FeedController extends Controller {

	/**
	 * var FeedRepository
	 */
	protected $feedRepository;

	/**
	 * Create a new instance of FeedController.
	 *
	 *
	 */
	public function __construct()
	{
		$this->currentUser = Auth::user();

		$this->middleware('auth');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(FeedRepository $feedRepository)
	{
		$user = $this->currentUser;

		$feeds = $feedRepository->getPublishedByUserAndFriends($user);

		$friendsUserIds[] = $user->id;

		$feedsCount = Feed::getTotalCountFeedsForUser($friendsUserIds);

		return view('feeds.index', compact('user', 'feeds', 'feedsCount'));
	}


	/**
	 *  Display more feeds via ajax.
	 *
	 * @param Request $request
	 *
	 * @return Response
	 */
	public function more(Request $request, FeedRepository $feedRepository)
	{
		$validator = Validator::make($request->all(), ['skipQty' => 'required']);

		if($validator->fails()) return abort(403);

		$feeds = $feedRepository->getPublishedByUserAndFriendsAjax($this->currentUser, $request->skipQty);

		return response()->json(['feeds' => $feeds]);
	}

	/**
	 * Store a newly created feed in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{

		$validator = Validator::make($request->all(), ['body'	=> 'required']);

		if($validator->fails()) return response()->json(['response' => 'failed']);

		$feed = $this->dispatchFrom(CreateFeedCommand::class, $request, [
				'body' => $request->body,
				'posterFirstname' => $this->currentUser->firstname,
				'posterProfileImage' => $this->currentUser->profileimage
				]);
		
		return response()->json([
				'response' => 'success',
				'userProfileImage' => $feed->poster_profile_image,
				'userFirstname' => $feed->poster_firstname,
				'feedBody' => $feed->body ]);	
	}

}
