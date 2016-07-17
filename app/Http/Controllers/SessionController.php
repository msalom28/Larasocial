<?php namespace App\Http\Controllers;

use App\Commands\LoginUserCommand;
use App\Commands\LogoutUserCommand;
use App\Http\Requests\CreateSessionRequest;
use Auth;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    /**
     * Store a new session.
     *
     * @param CreateSessionRequest $request
     *
     * @return Response
     */
    public function store(CreateSessionRequest $request)
    {
        $response = $this->dispatchFrom(LoginUserCommand::class, $request);

        if ($response) return redirect()->route('feeds_path')->with('welcome-message', trans('messages.welcome-message'));

        return redirect()->back()->withInput()->with('error', trans('messages.sign-in-error'));
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
