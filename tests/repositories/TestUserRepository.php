<?php

use Laracasts\TestDummy\Factory; 
use App\Repositories\User\EloquentUserRepository;

class TestUserRepository extends TestCase
{

	public function testGetPaginatedReturnsACollectionSuccesfully()
	{
		$currentUser = Factory::create('App\User');

		$users = Factory::times(20)->create('App\User');

		Auth::login($currentUser);

		$userRepository = new EloquentUserRepository;

		$this->assertEquals(10, count($userRepository->getPaginated()));

	}

	public function testFindManyById()
	{
		$users = Factory::times(20)->create('App\User');

		$ids = [];

		foreach ($users as $user) {
			
			$ids[] = $user->id;
		}

		$userRepository = new EloquentUserRepository;

		$result = $userRepository->findManyById($ids);

		$this->assertEquals(20, count($result));
	}


}