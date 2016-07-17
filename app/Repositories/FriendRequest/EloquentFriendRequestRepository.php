<?php namespace App\Repositories\FriendRequest;

use DB;

class EloquentFriendRequestRepository implements FriendRequestRepository
{
	public function getIdsThatSentRequestToCurrentUser($id)
	{
		return DB::table('friend_requests')->where('user_id', $id)->lists('requester_id');
	}
}