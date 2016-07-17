<?php namespace App\Http\Controllers;

use App;
use App\Commands\CreateMessageCommand;
use App\Http\Requests;
use App\Repositories\Message\MessageRepository;
use App\Repositories\User\UserRepository;
use Auth;
use Illuminate\Http\Request;
use Validator;

class MessageController extends Controller
{
    public function __construct()
    {
        $this->currentUser = Auth::user();

        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @param UserRepository $userRepository
     *
     * @return Response
     */
    public function index(UserRepository $userRepository)
    {
        $user = $this->currentUser;

        $messages = $userRepository->findByIdWithMessages($this->currentUser->id);

        return view('messages.index', compact('messages', 'user'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @param $id
     * @param UserRepository $userRepository
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
     * @param Request $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), ['body' => 'required']);

        if ($validator->fails()) {
            return response()->json(['response' => 'failed', 'message' => $validator->messages()->first('body')]);
        } else {
            $this->dispatchFrom(CreateMessageCommand::class, $request);

            return response()->json(['response' => 'success', 'message' => trans('messages.sent-successfully')]);
        }

    }

    /**
     * Display the specified message.
     *
     * @param  int $id
     * @param MessageRepository $messageRepository
     *
     * @return Response
     */
    public function show($id, MessageRepository $messageRepository)
    {
        $user = $this->currentUser;

        $message = $messageRepository->findByIdWithMessageResponses($id);

        return view('messages.show', compact('user', 'message'));
    }


    /**
     * Remove the specified email from storage.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function destroy(Request $request)
    {
        $validator = Validator::make($request->all(), ['messageId' => 'required']);

        if ($validator->fails()) return abort(403);

        $this->currentUser->messages()->detach($request->messageId);

        $messageCount = $this->currentUser->messages()->count();

        return response()->json(['count' => $messageCount]);
    }
}
