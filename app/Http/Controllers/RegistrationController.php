<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterUserRequest;
use App\Events\UserWasRegistered;
use App\Http\Controllers\Controller;
use App;

use Carbon\Carbon;
use App\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegistrationController extends Controller {

	/**
	 * Create a new instance of RegistrationController.
	 */
	public function __construct()
    {
       $this->middleware('guest');
    }

	/**
	 * Show a form to register a LaraSocial user.
	 *
	 * @return Response
	 */
	public function create()
	{
		$loginIdsRange = range(1, 30);

		shuffle($loginIdsRange);

		$loginIds = array_slice($loginIdsRange, 0, 2);

		$randomLogins = [];

		foreach ($loginIds as $loginId) {
			
			$randomLogins[] = User::find($loginId);
		}

		return view('registration.index', compact('randomLogins'));
	}

	/**
	 * Store a new LaraSocial user.
	 *
	 * @return Response
	 */
	public function store(RegisterUserRequest $request)
	{
		$newUserProfileImagePath = $profileImagePath = app('ProcessImage')->execute($request->file('profileimage'), public_path('images/profileimages'), 180, 180);

		$newUserBirthday = Carbon::createFromDate($request->year, $request->month, $request->day);

        $user = User::register(
            $request->get('firstname'),
            $request->get('lastname'),
            $request->get('email'),
            bcrypt($request->get('password')),
            $request->get('gender'),
            $newUserBirthday,
            $newUserProfileImagePath
        );

        $user->save();

        event(new UserWasRegistered($user));

        Auth::login($user);

        $user->updateOnlineStatus(1);

		return redirect()->route('feeds_path');

	}





}
