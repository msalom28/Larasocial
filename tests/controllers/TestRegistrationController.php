<?php

use App\Http\Controllers\RegistrationController;

class TestRegistrationController extends TestCase
{
	
	public function testCreateReturnsRegistrationViewOnSuccesfulRequest()
	{
		$registrationController = new RegistrationController;

		$response = $registrationController->create();

		$this->assertInstanceOf('Illuminate\View\View', $response);
	}
	
}