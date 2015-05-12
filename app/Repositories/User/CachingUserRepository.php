<?php namespace App\Repositories\User;

use Illuminate\Contracts\Cache\Repository as Cache;
use App\User;

class CachingUserRepository implements UserRepository
{

	/**
	 * @var App\Repositories\UserRepository
	 */
	private $repository;

	/**
	 * @var Illuminate\Contracts\Cache\Repository
	 */
	private $cache;

	/**
	 * @var int
	 */
	private $howMany;

	/**
	 * @var byFirstname
	 */
	private $byFirstname;


	/**
	 * Create a new instance of CachingUserRepository
	 */
	public function __construct(UserRepository $repository, Cache $cache)
	{
		$this->repository = $repository;

		$this->cache = $cache;
	}

	/**
	 * Get a cached paginated list of all users
	 * 	
	 *	@param int $howMany
	 * 	
	 *	@param string $byFirstname
	 *
	 *	@return mixed
	 */
	public function getPaginated($howMany = 10, $byFirstname = null)
	{
		$this->howMany = $howMany;

		$this->byFirstname = $byFirstname;

		if(! $this->byFirstname)
		{
			return $this->cache->remember('users.all', 20, function(){

			});	
		}
		else
		{
			return $this->repository->getPaginated($this->howMany, $this->byFirstname);
		}

	}

	/**
	 * Fetch a user by id
	 *
	 * @param int $id
	 *	
	 * @return mixed
	 */
	public function findById($id)
	{
		return $this->repository->findById($id);
	}

	/**
	 * Fetch a list of users by their ids
	 *
	 * @param  array $id
	 *	
	 * @return mixed
	 */
	public function findManyById(array $ids)
	{
		return $this->repository->findManyById($id);
	}

	/**
	 * Fetch a user by id with feeds attached
	 *
	 * @param int $id
	 *	
	 * @return mixed
	 */
	public function findByIdWithFeeds($id)
	{
		return $this->repository->findByIdWithFeeds($id);
	}

	/**
	 * Fetch a user by id with emails attached
	 *
	 * @param int $id
	 *	
	 * @return mixed
	 */
	public function findByIdWithMessages($id)
	{
		return $this->repository->findByIdWithMessages($id);
	}

		/**
	 * Fetch friend requests for a user
	 *
	 * @param int $id
	 *	
	 * @return mixed
	 */
	public function findByIdWithFriendRequests($id)
	{
		return $this->repository->findByIdWithFriendRequests($id);
	}

	/**
	 * Fetch friends for a user
	 *
	 * @param int $id
	 *	
	 * @return mixed
	 */
	public function findByIdWithFriends($id)
	{
		return $this->repository->findByIdWithFriends($id);
	}

}

