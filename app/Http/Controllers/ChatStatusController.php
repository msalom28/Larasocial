<?php namespace App\Http\Controllers;

use App\Commands\UpdateChatStatusCommand;
use App\Http\Requests;
use Illuminate\Http\Request;
use Validator;

class ChatStatusController extends Controller
{


    /**
     * Create a new StatusController instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Update current user's chat status.
     *
     * @param Request $request
     *
     * @return Mixed
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), ['chatStatus' => 'required']);
        if ($validator->fails()) return abort(403);
        $this->dispatchFrom(UpdateChatStatusCommand::class, $request);
    }
}
