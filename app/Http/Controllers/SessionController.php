<?php namespace App\Http\Controllers;

use App\Http\Requests\CreateSessionRequest;
use App\Http\Controllers\Controller;
use App\Commands\LoginUserCommand;
use App\Commands\LogoutUserCommand;
use Auth;
use Illuminate\Http\Request;

class SessionController extends Controller {


	/**
	 * Store a new session.
	 *
	 * @return Response
	 */
	public function store(CreateSessionRequest $request)
	{
		$response = $this->dispatchFrom(LoginUserCommand::class, $request);

		if($response) return redirect()->route('feeds_path')->with('welcome-message', 'You are now logged in.');
		
		return redirect()->back()->withInput()->with('error', 'We were unable to sign you in. Please check your credentials and try again.');
	}

	

	/**
	 * Logout the user.
	 *
	 * @param Request $request
	 *
	 * @return Response
	 */
	public function destroy(Request $request)
	{
		$this->dispatchFrom(LogoutUserCommand::class, $request, ['userId' => Auth::user()->id]);

		return response()->json(['response' => 'success']);
	}

}
