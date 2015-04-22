<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\User\UserRepository;
use App\Repositories\Feed\FeedRepository;
use Illuminate\Http\Request;
use Auth;

class UserController extends Controller {

	/**
	 * Create a new instance of UsersController
	 *
	 * @param Object $userRepository
	 *
	 */
	public function __construct()
	{
		$this->middleware('auth');

		$this->currentUser = Auth::user();
	}


	/**
	 * Display a listing of all the users.
	 *
	 * @param Request $request
	 *
	 * @return Response
	 */
	public function index(Request $request, UserRepository $userRepository)
	{
		$user = $this->currentUser;

		$users = $userRepository->getPaginated(null, $request->firstname);

		return view('users.index', compact('users', 'user'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified user.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function show($id, UserRepository $userRepository, FeedRepository $feedRepository)
	{
		$currentUser = $this->currentUser;

		$user = $userRepository->findById($id);

		$feeds = $feedRepository->getPublishedByUser($user);

		return view('users.show', compact('currentUser', 'user', 'feeds'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
