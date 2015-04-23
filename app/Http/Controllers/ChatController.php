<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\User\UserRepository;
use Illuminate\Http\Request;
use Validator;
use App\Commands\SendChatMessageCommand;

class ChatController extends Controller {

	/**
	 * Create a new ChatController instance
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}
	
	/**
	 * Send chat message to another user.
	 *
	 * @param Request $request
	 *
	 * @return mixed
	 */
	public function sendMessage(Request $request, UserRepository $userRepository)
	{
		$validator = Validator::make($request->all(), ['receiverId' => 'required', 'message' => 'required']);

		if($validator->fails())
		{
			if($validator->fails()) return abort(403);
		}
		else
		{
			$this->dispatchFrom(SendChatMessageCommand::class, $request);

			return response()->json(['response' => 'success', 'availableToChat' => $userRepository->findById($request->receiverId)->chatstatus]);
		}
	}
}
