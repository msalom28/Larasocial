<?php namespace App\Http\Controllers;

use App;
use App\Commands\RegisterUserCommand;
use App\Http\Requests\RegisterUserRequest;
use App\User;
use Carbon\Carbon;

class RegistrationController extends Controller
{
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
     * @param RegisterUserRequest $request
     *
     * @return Response
     */
    public function store(RegisterUserRequest $request)
    {
        $newUserProfileImagePath = $profileImagePath = App::make('ProcessImage')->execute($request->file('profileimage'), 'images/profileimages/', 180, 180);

        $newUserBirthday = Carbon::createFromDate($request->year, $request->month, $request->day);

        $this->dispatchFrom(RegisterUserCommand::class, $request, [
            'birthday' => $newUserBirthday,
            'profileImagePath' => $newUserProfileImagePath
        ]);

        return redirect()->route('feeds_path');
    }
}
