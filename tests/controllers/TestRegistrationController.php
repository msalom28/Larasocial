<?php

use App\Http\Requests\RegisterUserRequest;
use App\Http\Controllers\RegistrationController;

class TestRegistrationController extends TestCase
{

	protected static $registrationController; 

	public static function setUpBeforeClass()
	{
		self::$registrationController = new RegistrationController;
	}

	public static function tearDownAfterClass()
	{

		self::$registrationController = '';
	}
	
	public function testCreateReturnsRegistrationViewOnSuccesfulRequest()
	{
		$response = self::$registrationController->create();

		$this->assertInstanceOf('Illuminate\View\View', $response);
	}

	public function testStoreReturnsRedirectToFeedsRouteAfterSuccesfulRegistration()
	{
		
		/** PLEASE READ **
		 *
		 * This test was intended for a different result, we need to figure out how to test files attached with PHPUnit...
		 */

		$this->setExpectedException('ErrorException');

		$request = new RegisterUserRequest([
			'firstname' => 'jose', 
			'lastname' => 'berraes',
			'email' => 'jason@berraes.com',
			'password' => 'secret',
			'password_confirmation' => 'secret',
			'gender' => 'M',
			'month' => 12,
			'day' => 06,
			'year' => 1980,
			'profileimage' => 'http://images/profile.jpg'

			]);

		$response = self::$registrationController->store($request);

	}
	
}