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

		self::$registrationController = null;
	}
	
	public function testCreateReturnsViewInstance()
	{
		$response = self::$registrationController->create();

		$this->assertInstanceOf('Illuminate\View\View', $response);
	}

	
}