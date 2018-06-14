<?php 

use Laracasts\TestDummy\Factory;
use App\Events\UserWasRegistered;

class TestEmailRegistrationConfirmation extends TestCase
{
    use \Illuminate\Foundation\Testing\DatabaseTransactions;

    public function testHandleReturnsTrueAfterUserWasRegistered()
	{
		$user = factory(\App\User::class)->create();
        $user = factory(\App\User::class)->create();

        $mailer = new \Illuminate\Support\Testing\Fakes\MailFake();
        $this->app->instance('mailer', $mailer);

        event(new UserWasRegistered($user));

        $mailer->assertSent(\App\Mail\Welcome::class, function ($mail) use ($user) {
            return $mail->hasTo($user->email);
        });




	}
}