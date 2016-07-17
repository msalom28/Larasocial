<?php namespace App\Repositories\FriendRequest;

interface FriendRequestRepository
{
	public function getIdsThatSentRequestToCurrentUser($id);
}