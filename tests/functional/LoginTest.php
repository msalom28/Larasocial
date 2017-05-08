<?php 

use Laracasts\TestDummy\Factory;

class LoginTest extends BrowserKitTestCase
{
    use \Illuminate\Foundation\Testing\DatabaseTransactions;

	public function testEmptyEmailShowsErrorOnSubmit()
	{
	    $this->visit('/')
        ->submitForm('Sign in', ['email' => '', 'password' => 'secret'])
        ->See('The email field is required')
        ->seePageIs('/');
	}

	public function testInvalidEmailShowsErrorOnSubmit()
	{
	    $this->visit('/')
        ->submitForm('Sign in', ['email' => 'jondoe.com', 'password' => 'secret'])
        ->See('The email must be a valid email address.')
        ->seePageIs('/');
	}

	public function testEmptyPasswordShowsErrorOnSubmit()
	{
	    $this->visit('/')
        ->submitForm('Sign in', ['email' => 'jon@Doe.com', 'password' => ''])
        ->See('The password field is required')
        ->seePageIs('/');
	}

	public function testLoginWithWrongCedentialsShowsError()
	{
	    $this->visit('/')
        ->submitForm('Sign in', ['email' => 'jon@Doe.com', 'password' => 'heheheh'])
        ->See('We were unable to sign you in. Please check your credentials and try again.')
        ->seePageIs('/');
	}

}