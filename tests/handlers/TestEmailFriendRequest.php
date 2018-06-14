<?php 

use Laracasts\TestDummy\Factory;
use App\Events\FriendRequestWasSent;

class TestEmailFriendRequest extends TestCase
{
    use \Illuminate\Foundation\Testing\DatabaseTransactions;

    public function testHandleReturnsTrueAfterFriendRequestWasSent()
	{
		$requesterUser = factory(\App\User::class)->create();

		$requestedUser = factory(\App\User::class)->create();
        $mailer = new \Illuminate\Support\Testing\Fakes\MailFake();
        $this->app->instance('mailer', $mailer);

		event(new FriendRequestWasSent($requestedUser, $requesterUser));


        $mailer->assertSent(\App\Mail\FriendRequest::class, function ($mail) use ($requestedUser) {
            return $mail->hasTo($requestedUser->email);
        });

    }
}