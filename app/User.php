<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use DB;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

	use Authenticatable, CanResetPassword;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['firstname', 'lastname', 'email', 'password', 'gender', 'birthday', 'profileimage'];
	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];

	/**
	 * A User can have many feeds.
	 *
	 * @return collection
	 */
	public function feeds()
	{
		return $this->hasMany('App\Feed')->latest();
	}

	/**
	 * A User can have many friend requests.
	 *
	 * @return collection
	 */
	public function friendRequests()
	{
		return $this->hasMany('App\FriendRequest');
	}

	/**
	 * A user can have many friends.
	 * 	
	 * @return Collection
	 *
	 */
	public function friends()
	{
		return $this->belongsToMany(Self::class, 'friends', 'requested_id', 'requester_id')->withTimestamps();
	}

	/**
	 * A user belons to many messages.
	 *
	 * @return Collection
	 */
	 public function messages()
    {
        return $this->belongsToMany('App\Message')->withTimestamps();
    }

    /**
	 * A user has many message responses.
	 *
	 * @return Collection
	 */
	 public function messageResponses()
    {
        return $this->belongsToMany('App\MessageResponse')->withTimestamps();
    }


	/**
	 * Register a new Larasocial user.
	 *
	 * @param string $firstname
	 *
	 * @param string $lastname
	 *
	 * @param string $email
	 *
	 * @param string $password
	 *
	 * @param string $gender
	 *
	 * @param string $birthday
	 *
	 * @param string $profileimage
	 *
	 * @return User $user
	 */
	public static function register($firstname, $lastname, $email, $password, $gender, $birthday, $profileimage)
	{
		$user = new static(compact('firstname', 'lastname', 'email', 'password', 'gender', 'birthday', 'profileimage'));

		return $user;
	}

	/**
	 * Add a friend to a user.
	 *	
	 * @param int $requestedUserId
	 *
	 * @return mixed
	 */
	public function createFriendShipWith($requesterUserId)
	{
		return $this->friends()->attach($requesterUserId, ['requested_id' => $this->id, 'requester_id' => $requesterUserId]);	
	}

	
	/**
	 * Remove a friend from a user.
	 *	
	 * @param int $requestedUserId
	 *
	 * @return mixed
	 */
	public function finishFriendshipWith($requesterUserId)
	{
		return $this->friends()->detach($requesterUserId, ['requested_id' => $this->id, 'requester_id' => $requesterUserId]);
	}



	/**
	 * Update the online status of current user
	 *	
	 * @param int $status
     *
	 * @return mixed
	 */
	public function updateOnlineStatus($status)
	{
	 	$this->onlinestatus = $status;

	 	$this->save();
	}

	/**
	 * Determine if current user is friends with another user.
	 *	
	 * @param int $otherUserId
     *
	 * @return boolean
	 */
	public function isFriendsWith($otherUserId)
	{
		$currentUserFriends = DB::table('friends')->where('requester_id', $this->id)->lists('requested_id');

		return in_array($otherUserId, $currentUserFriends);		
	}

	/**
	 * Determine if current user has sent a friend request to another user.
	 *	
	 * @param int $otherUserId
     *
	 * @return boolean
	 */
	public function sentFriendRequestTo($otherUserId)
	{
		$friendRequestedByCurrentUser = DB::table('friend_requests')->where('requester_id', $this->id)->lists('user_id');

		return in_array($otherUserId, $friendRequestedByCurrentUser);
	}

	/**
	 * Determine if current user has received a friend request from another user.
	 *	
	 * @param int $otherUserId
     *
	 * @return boolean
	 */
	public function receivedFriendRequestFrom($otherUserId)
	{
		$friendRequestsReceivedByCurrentUser = DB::table('friend_requests')->where('user_id', $this->id)->lists('requester_id');
		
		return in_array($otherUserId, $friendRequestsReceivedByCurrentUser);
	}


	/**
	 * Determine if the current user is the same as the given one.
	 *
	 * @param int $id
	 *
	 * @return boolean
	 *
	 */
	public function is($id)
	{
		return $this->id == $id;
	}

	/**
	 * Determine if current user is available to chat.
     *
	 * @return boolean
	 */
	public function isAvailableToChat()
	{
	 	return $this->chatstatus;
	}

	/**
	 * Update current user's chat status.
	 *	
	 * @param  boolean $chatStatus
     *
	 * @return mixed
	 */
	public function updateChatStatus($chatStatus)
	{
		$this->chatstatus = $chatStatus;
		
		$this->save();	
	}

	/**
	 * Determine if current user is online.
	 *	
	 * @return boolean
	 */
	public function isOnline()
	{
	 	return $this->onlinestatus;
	}

}
