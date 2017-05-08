<?php

use Laracasts\TestDummy\Factory; 

class RegistrationTest extends BrowserKitTestCase
{
    use \Illuminate\Foundation\Testing\DatabaseTransactions;

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
            ->see('Your first name is required.')
            ->seePageIs('/');
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
            ->see('Your first name must have at least 2 characters.')
            ->seePageIs('/');
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
            ->see('Your first name may only contain letters.')
            ->seePageIs('/');
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
            ->see('Your last name is required.')
            ->seePageIs('/');
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
            ->see('Your last name must have at least 2 characters.')
            ->seePageIs('/');
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
            ->see('Your last name may only contain letters.')
            ->seePageIs('/');
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
            ->see('The email field is required.')
            ->seePageIs('/');
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
            ->see('The email has already been taken.')
            ->seePageIs('/');
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
            ->see('The password field is required.')
            ->seePageIs('/');
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
            ->see('The password confirmation does not match.')
            ->seePageIs('/');
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
            ->see('The password must be between 4 and 12 characters.')
            ->seePageIs('/');
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
            ->see('The password confirmation field is required.')
            ->seePageIs('/');
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
            ->see('The year field is required')
            ->seePageIs('/');
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
            ->see('The year must be a number.')
            ->seePageIs('/');
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
            ->see('The year must be a date before 2002.')
            ->seePageIs('/');
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
            ->see('Your profile image is required.')
            ->seePageIs('/');
	}


}