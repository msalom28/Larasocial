<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\User\UserRepository;
use App\Commands\CreateMessageCommand;
use Illuminate\Http\Request;
use Validator;
use Auth;
use App;

class MessageController extends Controller {


	public function __construct()
	{
		$this->currentUser = Auth::user();

		$this->middleware('auth');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{

	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create($id, UserRepository $userRepository)
	{
		$currentUser = $this->currentUser;

		$user = $userRepository->findById($id);

		return view('messages.create', compact('currentUser', 'user'));

	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$validator = Validator::make($request->all(), App::make('MessageRequest')->rules());

		if($validator->fails())
		{
			return response()->json(['response' => 'failed', 'message' => $validator->messages()->first('body')]);
		}
		else
		{
			$this->dispatchFrom(CreateMessageCommand::class, $request);
			
			return response()->json(['response' => 'success', 'message' => 'Your message was sent.']);
		}

	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
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
