<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class FriendRequest extends Model {

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['requested_id', 'requester_id'];


	/**
	 * A feed belongs to a User.
	 *
	 * @return User
	 */
	public function user()
	{
		return $this->belongsTo('App\User');
	}


	/**
	 * Send a friend request to a user
	 *
	 * @attr int $requested_id
	 *
	 * @attr int $requester_id 
	 *
	 */
	public static function prepareFriendRequest($requested_id, $requester_id)
	{
		$FriendRequest = new static(compact('requested_id', 'requester_id'));

		return $FriendRequest;
	}

}
