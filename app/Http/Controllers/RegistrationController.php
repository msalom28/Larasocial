<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

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
	public function store()
	{
		//
	}





}
