<?php namespace App\Repositories\User;

use App\User;

interface UserRepository
{	
	public function getPaginated($howMany, $byKeyword);
	public function findById($id);
	public function findByIdWithFeeds($id);
	public function findByIdWithEmails($id);
	public function findByIdWithFriendRequests($userId);
	public function findByIdWithFriends($userId);
}