<?php

use Laracasts\TestDummy\Factory; 

class RegistrationTest extends TestCase
{
	public function testEmptyFirstnameShowsErrorOnSubmit()
	{
		    $this->visit('/')
            ->submitForm('Submit', [

			'firstname'				=>	'',
			'lastname'				=>	'Doe',
			'email'					=> 	'Doe@example.com',
			'password'				=>	'secret',
			'password_confirmation'	=> 	'secret',
			'gender'				=>	'M',
			'month'					=>	12,
			'day'					=>	11,			
			'year'					=>	2000,
			'profileimage'			=>	''
		])
            ->andSee('Your first name is required.')
            ->onPage('/');
	}

	public function testFirstNameTooShortShowsErrorOnSubmit()
	{
		    $this->visit('/')
            ->submitForm('Submit', [

			'firstname'				=>	'g',
			'lastname'				=>	'Doe',
			'email'					=> 	'Doe@example.com',
			'password'				=>	'secret',
			'password_confirmation'	=> 	'secret',
			'gender'				=>	'M',
			'month'					=>	12,
			'day'					=>	11,			
			'year'					=>	2000,
			'profileimage'			=>	''
		])
            ->andSee('Your first name must have at least 2 characters.')
            ->onPage('/');
	}

	public function testFirstNameContainNumberShowsErrorOnSubmit()
	{
		    $this->visit('/')
            ->submitForm('Submit', [

			'firstname'				=>	'able1235',
			'lastname'				=>	'Doe',
			'email'					=> 	'Doe@example.com',
			'password'				=>	'secret',
			'password_confirmation'	=> 	'secret',
			'gender'				=>	'M',
			'month'					=>	12,
			'day'					=>	11,			
			'year'					=>	2000,
			'profileimage'			=>	''
		])
            ->andSee('Your first name may only contain letters.')
            ->onPage('/');
	}

	public function testLastNameEmptyShowsErrorOnSubmit()
	{
		    $this->visit('/')
            ->submitForm('Submit', [

			'firstname'				=>	'able',
			'lastname'				=>	'',
			'email'					=> 	'Doe@example.com',
			'password'				=>	'secret',
			'password_confirmation'	=> 	'secret',
			'gender'				=>	'M',
			'month'					=>	12,
			'day'					=>	11,			
			'year'					=>	2000,
			'profileimage'			=>	''
		])
            ->andSee('Your last name is required.')
            ->onPage('/');
	}

	public function testLastNameTooShortShowsErrorOnSubmit()
	{
		    $this->visit('/')
            ->submitForm('Submit', [

			'firstname'				=>	'able',
			'lastname'				=>	'g',
			'email'					=> 	'Doe@example.com',
			'password'				=>	'secret',
			'password_confirmation'	=> 	'secret',
			'gender'				=>	'M',
			'month'					=>	12,
			'day'					=>	11,			
			'year'					=>	2000,
			'profileimage'			=>	''
		])
            ->andSee('Your last name must have at least 2 characters.')
            ->onPage('/');
	}

	public function testLastNameContainNumberShowsErrorOnSubmit()
	{
		    $this->visit('/')
            ->submitForm('Submit', [

			'firstname'				=>	'able',
			'lastname'				=>	'Doe125',
			'email'					=> 	'Doe@example.com',
			'password'				=>	'secret',
			'password_confirmation'	=> 	'secret',
			'gender'				=>	'M',
			'month'					=>	12,
			'day'					=>	11,			
			'year'					=>	2000,
			'profileimage'			=>	''
		])
            ->andSee('Your last name may only contain letters.')
            ->onPage('/');
	}

	public function testEmptyEmailShowsErrorOnSubmit()
	{
		    $this->visit('/')
            ->submitForm('Submit', [

			'firstname'				=>	'able',
			'lastname'				=>	'Doe',
			'email'					=> 	'',
			'password'				=>	'secret',
			'password_confirmation'	=> 	'secret',
			'gender'				=>	'M',
			'month'					=>	12,
			'day'					=>	11,			
			'year'					=>	2000,
			'profileimage'			=>	''
		])
            ->andSee('The email field is required.')
            ->onPage('/');
	}

	public function testTakenEmailShowsErrorOnSubmit()
	{

			$user = Factory::create('App\User');

		    $this->visit('/')
            ->submitForm('Submit', [

			'firstname'				=>	'able',
			'lastname'				=>	'Doe',
			'email'					=> 	$user->email,
			'password'				=>	'secret',
			'password_confirmation'	=> 	'secret',
			'gender'				=>	'M',
			'month'					=>	12,
			'day'					=>	11,			
			'year'					=>	2000,
			'profileimage'			=>	''
		])
            ->andSee('The email has already been taken.')
            ->onPage('/');
	}

	public function testEmptyPasswordShowsErrorOnSubmit()
	{
		    $this->visit('/')
            ->submitForm('Submit', [

			'firstname'				=>	'able',
			'lastname'				=>	'Doe',
			'email'					=> 	'doe@email.com',
			'password'				=>	'',
			'password_confirmation'	=> 	'secret',
			'gender'				=>	'M',
			'month'					=>	12,
			'day'					=>	11,			
			'year'					=>	2000,
			'profileimage'			=>	''
		])
            ->andSee('The password field is required.')
            ->onPage('/');
	}

	public function testConfirmPasswordShowsErrorOnSubmit()
	{
		    $this->visit('/')
            ->submitForm('Submit', [

			'firstname'				=>	'able',
			'lastname'				=>	'Doe',
			'email'					=> 	'doe@email.com',
			'password'				=>	'hello',
			'password_confirmation'	=> 	'secret',
			'gender'				=>	'M',
			'month'					=>	12,
			'day'					=>	11,			
			'year'					=>	2000,
			'profileimage'			=>	''
		])
            ->andSee('The password confirmation does not match.')
            ->onPage('/');
	}

	public function testPasswordTooShortShowsErrorOnSubmit()
	{
		    $this->visit('/')
            ->submitForm('Submit', [

			'firstname'				=>	'able',
			'lastname'				=>	'Doe',
			'email'					=> 	'doe@email.com',
			'password'				=>	'h',
			'password_confirmation'	=> 	'secret',
			'gender'				=>	'M',
			'month'					=>	12,
			'day'					=>	11,			
			'year'					=>	2000,
			'profileimage'			=>	''
		])
            ->andSee('The password must be between 4 and 12 characters.')
            ->onPage('/');
	}

	public function testEmptyPasswordConfirmationShowsErrorOnSubmit()
	{
		    $this->visit('/')
            ->submitForm('Submit', [

			'firstname'				=>	'able',
			'lastname'				=>	'Doe',
			'email'					=> 	'doe@email.com',
			'password'				=>	'secret',
			'password_confirmation'	=> 	'',
			'gender'				=>	'M',
			'month'					=>	12,
			'day'					=>	11,			
			'year'					=>	2000,
			'profileimage'			=>	''
		])
            ->andSee('The password confirmation field is required.')
            ->onPage('/');
	}

	public function testEmptyYearShowsErrorOnSubmit()
	{
		    $this->visit('/')
            ->submitForm('Submit', [

			'firstname'				=>	'able',
			'lastname'				=>	'Doe',
			'email'					=> 	'doe@email.com',
			'password'				=>	'secret',
			'password_confirmation'	=> 	'secret',
			'gender'				=>	'M',
			'month'					=>	'12',
			'day'					=>	11,			
			'year'					=>	'',
			'profileimage'			=>	''
		])
            ->andSee('The year field is required')
            ->onPage('/');
	}

	public function testNumericYearShowsErrorOnSubmit()
	{
		    $this->visit('/')
            ->submitForm('Submit', [

			'firstname'				=>	'able',
			'lastname'				=>	'Doe',
			'email'					=> 	'doe@email.com',
			'password'				=>	'secret',
			'password_confirmation'	=> 	'secret',
			'gender'				=>	'M',
			'month'					=>	'12',
			'day'					=>	11,			
			'year'					=>	'bab1',
			'profileimage'			=>	''
		])
            ->andSee('The year must be a number.')
            ->onPage('/');
	}

	public function testYearBeforeCurrentShowsErrorOnSubmit()
	{
		    $this->visit('/')
            ->submitForm('Submit', [

			'firstname'				=>	'able',
			'lastname'				=>	'Doe',
			'email'					=> 	'doe@email.com',
			'password'				=>	'secret',
			'password_confirmation'	=> 	'secret',
			'gender'				=>	'M',
			'month'					=>	'12',
			'day'					=>	11,			
			'year'					=>	'2015',
			'profileimage'			=>	''
		])
            ->andSee('The year must be a date before 2000.')
            ->onPage('/');
	}

	public function testEmptyImageShowsErrorOnSubmit()
	{
		    $this->visit('/')
            ->submitForm('Submit', [

			'firstname'				=>	'able',
			'lastname'				=>	'Doe',
			'email'					=> 	'doe@email.com',
			'password'				=>	'secret',
			'password_confirmation'	=> 	'secret',
			'gender'				=>	'M',
			'month'					=>	'12',
			'day'					=>	11,			
			'year'					=>	'1980',
			'profileimage'			=>	''
		])
            ->andSee('Your profile image is required.')
            ->onPage('/');
	}


}