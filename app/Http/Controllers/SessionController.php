<?php namespace App\Http\Controllers;

use App\Http\Requests\CreateSessionRequest;
use App\Http\Controllers\Controller;
use App\Jobs\LoginUserCommand;
use App\Jobs\LogoutUserCommand;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionController extends Controller {

	/**
	 * Store a new session.
	 *
	 * @return Response
	 */
	public function store(CreateSessionRequest $request)
	{
        $authResult = Auth::attempt(['email' => $request->get('email'), 'password' => $request->get('password')]);

        if( $authResult )
        {
            $this->dispatch(new LoginUserCommand(Auth::user()));

            return redirect()->route('feeds_path')->with('welcome-message', 'You are now logged in.');
        }

		return redirect()->back()->withInput()->with('error', 'We were unable to sign you in. Please check your credentials and try again.');
	}


    /**
     * Logout the user.
     * @return array
     */
	public function destroy()
	{
		$this->dispatch(new LogoutUserCommand(Auth::user()->id));

		return response()->json(['response' => 'success']);
	}

}
