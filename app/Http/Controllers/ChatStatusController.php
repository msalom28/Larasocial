<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;
use Illuminate\Http\Request;
use App\Jobs\UpdateChatStatusCommand;

class ChatStatusController extends Controller {


	/**
	 * Create a new StatusController instance.
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}


    /**
     *
     * Update current user's chat status.
     *
     * @param Request $request
     */
	public function update(Request $request)
	{
		$validator = Validator::make($request->all(), ['chatStatus' => 'required']);

		if($validator->fails()) return abort(403);

		$this->dispatch( new UpdateChatStatusCommand( $request->get('chatStatus') ) );
	}

}
