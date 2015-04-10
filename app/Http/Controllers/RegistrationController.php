<?php namespace App\Http\Controllers;

use App\Http\Requests\RegisterUserRequest;
use App\Http\Controllers\Controller;
use App\Commands\RegisterUserCommand;
use App;
use Carbon\Carbon;

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
		return view('registration.index');
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

	}





}
