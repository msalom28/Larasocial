<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;
use App\Commands\CreateMessageResponseCommand;
use Auth;
use App;
use Validator;

class MessageResponseController extends Controller {


	/**
	 * Create a new instance of ResponsesController
	 */
	public function __construct()
	{
		$this->middleware('auth');

		$this->currentUser = Auth::user();
	}

	/**
	 * Store a newly created response in storage.
	 *
	 * @param Request $request
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$validator = Validator::make($request->all(), ['body' => 'required']);

		if($validator->fails()) return response()->json(['response' => 'failed']);		
		
			$this->dispatchFrom(CreateMessageResponseCommand::class, $request, [

				'receiverId' 			=> $request->receiverId,
				'body'					=> $request->body,
				'senderId'				=> $request->senderId,
				'senderProfileImage'	=> $request->senderProfileImage,
				'senderName'			=> $request->senderName,
				'messageId'				=> $request->messageId,
				'currentUser'			=> $this->currentUser 

			]);

			return response()->json(['response' => 'success', 'message' => 'Your message was sent.']);
	}

	/**
	 * Update the specified message response in storage.
	 *
	 * @param Request $request
	 * @return mixed
	 */
	public function update(Request $request)
	{
		DB::table('message_response_user')
		->where('user_id', $this->currentUser->id)
		->where('message_response_id', $request->messageResponseId)
		->update(['open' => $request->openValue]);

		return response()->json(['response' => 'success']);	
	}

}
