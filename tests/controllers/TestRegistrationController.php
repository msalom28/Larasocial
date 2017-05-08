<?php

use App\Http\Requests\RegisterUserRequest;
use App\Http\Controllers\RegistrationController;
use \Illuminate\Http\UploadedFile;

class TestRegistrationController extends TestCase
{
use \Illuminate\Foundation\Testing\WithoutMiddleware, \Illuminate\Foundation\Testing\DatabaseTransactions;

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

    public function testHandleReturnsUserAfterRegisteringSuccessfully()
    {
        $response = $this->post('/',
            [
            'firstname' => 'jose',
            'lastname' => 'rodriges',
            'email' => 'jose@gmail.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'gender' => 'M',
            'month' => 12,
            'day' => 06,
            'year' => 1980,
            'profileimage' => UploadedFile::fake()->image('avatar.jpg'),
            ]
        );

        $this->assertDatabaseHas('users', [
            'email' => 'jose@gmail.com',
            'firstname' => 'jose',

        ]);

        $response->assertRedirect('feeds');

        $this->assertTrue(Auth::check());

    }

	
}