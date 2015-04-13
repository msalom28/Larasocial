<?php namespace App\Repositories\Feed;

use App\User;

interface FeedRepository
{
	public function getPublishedByUserAndFriends(User $user);
	
	public function getPublishedByUserAndFriendsAjax(User $user, $skipQty);
	
}