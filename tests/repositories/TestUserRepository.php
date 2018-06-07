<?php

use Laracasts\TestDummy\Factory; 
use App\Repositories\User\EloquentUserRepository;

class TestUserRepository extends TestCase
{

    use \Illuminate\Foundation\Testing\DatabaseTransactions;

	public function testGetPaginatedReturnsACollectionSuccesfully()
	{
		$currentUser = factory(\App\User::class)->create();

        $users = factory(\App\User::class,20)->create();

		Auth::login($currentUser);

		$userRepository = new EloquentUserRepository;

		$this->assertEquals(10, count($userRepository->getPaginated()));

	}

	public function testFindManyById()
	{
        $users = factory(\App\User::class,20)->create();

        $ids = [];

		foreach ($users as $user) {
			
			$ids[] = $user->id;
		}

		$userRepository = new EloquentUserRepository;

		$result = $userRepository->findManyById($ids);

		$this->assertEquals(20, count($result));
	}


}