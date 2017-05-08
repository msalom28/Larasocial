<?php namespace App\Http\Controllers;

use App\Jobs\CreateFeedCommand;
use App\Http\Controllers\Controller;
use App\Repositories\Feed\FeedRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

		$this->middleware('auth');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(FeedRepository $feedRepository)
	{
		$user = Auth::user();

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

		$feeds = $feedRepository->getPublishedByUserAndFriendsAjax(Auth::user(), $request->skipQty);

		return response()->json(['feeds' => $feeds]);
	}

	/**
	 * Store a newly created feed in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
        $user = Auth::user();

	    $validator = Validator::make($request->all(), ['body'	=> 'required']);

		if($validator->fails()) return response()->json(['response' => 'failed']);

		$feed = Feed::publish($request->body, $user->firstname, $user->profileimage);

        $user->feeds()->save($feed);
        
		return response()->json([
				'response' => 'success',
				'userProfileImage' => $feed->poster_profile_image,
				'userFirstname' => $feed->poster_firstname,
				'feedBody' => $feed->body ]);	
	}

}
