<?php 

use Laracasts\TestDummy\Factory;

class LoginTest extends TestCase
{

	public function testEmptyEmailShowsErrorOnSubmit()
	{
	    $this->visit('/')
        ->submitForm('Sign in', ['email' => '', 'password' => 'secret'])
        ->andSee('The email field is required')
        ->onPage('/');
	}

	public function testInvalidEmailShowsErrorOnSubmit()
	{
	    $this->visit('/')
        ->submitForm('Sign in', ['email' => 'jondoe.com', 'password' => 'secret'])
        ->andSee('The email must be a valid email address.')
        ->onPage('/');
	}

	public function testEmptyPasswordShowsErrorOnSubmit()
	{
	    $this->visit('/')
        ->submitForm('Sign in', ['email' => 'jon@Doe.com', 'password' => ''])
        ->andSee('The password field is required')
        ->onPage('/');
	}

	public function testLoginWithWrongCedentialsShowsError()
	{
	    $this->visit('/')
        ->submitForm('Sign in', ['email' => 'jon@Doe.com', 'password' => 'heheheh'])
        ->andSee('We were unable to sign you in. Please check your credentials and try again.')
        ->onPage('/');
	}

}