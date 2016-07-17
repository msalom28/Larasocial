<?php namespace App\Commands;

use App\Realtime\Events as SocketClient;
use Auth;
use Illuminate\Contracts\Bus\SelfHandling;

class UpdateChatStatusCommand extends Command implements SelfHandling
{

    /**
     * @var boolean
     */
    protected $chatStatus;

    /**
     * @var Object
     */
    protected $currentUser;

    /**
     * @var Object
     */
    protected $socketClient;


    /**
     * Create a new command instance.
     *
     * @param boolean $chatStatus
     */
    public function __construct($chatStatus)
    {
        $this->chatStatus = $chatStatus;
        $this->socketClient = new SocketClient;
        $this->currentUser = Auth::user();
    }

    /**
     * Execute the command.
     *
     * @return void
     */
    public function handle()
    {
        $this->currentUser->updateChatStatus($this->chatStatus);
        $relatedToId = $this->currentUser->id;
        $friendsUserIds = $this->currentUser->friends()->where('onlinestatus', 1)->lists('requester_id');
        $friendsUserIds[] = $relatedToId;
        $this->socketClient->updateChatStatusBar($friendsUserIds, 21, $relatedToId, $this->chatStatus);
    }

}
