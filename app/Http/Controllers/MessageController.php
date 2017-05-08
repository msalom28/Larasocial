<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\User\UserRepository;
use App\Repositories\Message\MessageRepository;
use App\jobs\CreateMessageCommand;
use Illuminate\Http\Request;
use Validator;
use Auth;
use App;

class MessageController extends Controller {


	public function __construct()
	{

		$this->middleware('auth');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(UserRepository $userRepository)
	{
		$user = Auth::user();

		$messages = $userRepository->findByIdWithMessages($user->id);

		return view('messages.index', compact('messages', 'user'));

	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create($id, UserRepository $userRepository)
	{
		$currentUser = Auth::user();

		$user = $userRepository->findById($id);

		return view('messages.create', compact('currentUser', 'user'));

	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$validator = Validator::make($request->all(), ['body' => 'required']);

		if($validator->fails())
		{
			return response()->json(['response' => 'failed', 'message' => $validator->messages()->first('body')]);
		}
		else
		{
		    $this->dispatch(new CreateMessageCommand(
		        $request->get('receiverId'),
                $request->get('body'),
                $request->get('senderId'),
                $request->get('senderProfileImage'),
                $request->get('senderName')
            ) );
			
			return response()->json(['response' => 'success', 'message' => 'Your message was sent.']);
		}

	}

	/**
	 * Display the specified message.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function show($id, MessageRepository $messageRepository)
	{
		$user = Auth::user();

		$message = $messageRepository->findByIdWithMessageResponses($id);

		return view('messages.show', compact('user', 'message'));
	}
	

	/**
	 * Remove the specified email from storage.
	 *
	 * @param Request $request
	 *
	 * @return Response
	 */
	public function destroy(Request $request)
	{
		$validator = Validator::make($request->all(), ['messageId' => 'required']);

		$user = Auth::user();

		if($validator->fails()) return abort(403);

        $user->messages()->detach($request->messageId);

		$messageCount = $user->messages()->count();

		return response()->json(['count' => $messageCount ]);
	}

}
