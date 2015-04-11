<?php

use App\Commands\RegisterMemberCommand; 

class TestRegisterUserCommand
{
	public function testHandleReturnsUserAfterRegisteringSuccessfully()
	{
		$handler = new RegisterMemberCommand(
		'jose',
		'rodriges',
		'jose@gmail.com',
		'password',
		'password',
		'M',
		12,
		06,
		1980,
		'http://images/image1.jpg',
		'http://images/image1.jpg',
		'12/06/1980'
		);

		$user = $handler->handle();

		$this->assertInstanceOf('App\User', $user);

		$this->assertTrue(Auth::check());

	}
}


