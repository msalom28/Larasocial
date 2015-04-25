<?php namespace App\Http\Controllers;

use App\Http\Requests\RegisterUserRequest;
use App\Http\Controllers\Controller;
use App\Commands\RegisterUserCommand;
use App;
use Carbon\Carbon;
use App\User;

use Illuminate\Http\Request;

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
		$newUserProfileImagePath = $profileImagePath = App::make('ProcessImage')->execute($request->file('profileimage'), 'images/profileimages/', 180, 180);

		$newUserBirthday = Carbon::createFromDate($request->year, $request->month, $request->day);

		$newUser = $this->dispatchFrom(RegisterUserCommand::class, $request, [
			'birthday' => $newUserBirthday, 
			'profileImagePath' => $newUserProfileImagePath
		]);

		return redirect()->route('feeds_path');

	}





}
