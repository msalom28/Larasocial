<?php

use Laracasts\TestDummy\Factory;
use App\Http\Controllers\SessionController;
use App\Http\Requests\CreateSessionRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class testSessionController extends TestCase
{

    use \Illuminate\Foundation\Testing\DatabaseTransactions;

    protected static $sessionControlller;

	public static function setUpBeforeClass()
	{
		self::$sessionControlller = new SessionController;
	}

	public function testStoreReturnsRedirectResponseInstance()
	{
		$tempUser = Factory::create('App\User');

		$request = new CreateSessionRequest(['email' => $tempUser->email, 'password' => $tempUser->password]);

		$response =  self::$sessionControlller->store($request);

		$this->assertInstanceOf('Illuminate\Http\RedirectResponse', $response);

        Auth::logout();

	}


	public function testStoreReturnsRedirectResponseInstanceLoginWrong()
	{
		$request = new CreateSessionRequest(['email' => 'jon@example.com', 'password' => 'secret']);

		$response =  self::$sessionControlller->store($request);

		$this->assertFalse(Auth::check());

		$this->assertInstanceOf('Illuminate\Http\RedirectResponse', $response);

        Auth::logout();

	}

	public function testDestroyReturnsJsonResponseInstance()
	{
		$tempUser = Factory::create('App\User');

		Auth::login($tempUser);

		$request = new Request(['userId' => $tempUser->id]);

		$response =  self::$sessionControlller->destroy($request);

		$this->assertFalse(Auth::check());

		$this->assertInstanceOf('Illuminate\Http\JsonResponse', $response);

        Auth::logout();

	}	
}