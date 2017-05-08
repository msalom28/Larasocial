<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class FriendRequest extends Mailable
{
    use Queueable, SerializesModels;

    public $userFirstname;

    public $requesterFirstname;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $requested, User $requester )
    {
        $this->userFirstname = $requested->firstname;

        $this->requesterFirstname = $requester->firstname;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Someone would like to be your friend')
            ->view('email-alerts.friend-request');
    }
}
