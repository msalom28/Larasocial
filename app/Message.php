<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model {

	/**
	 * These fields could be mass assigned
	 */
	protected $fillable = ['user_id', 'body', 'senderid', 'senderprofileimage', 'sendername'];

	/**
	 * A message belongs to Many Users.
	 *
	 * @return Collection
	 */
	 public function users()
    {
        return $this->belongsToMany('App\User')->withTimestamps();
    }

     /**
	 *  Create a new message object. 
	 *
	 *	@param string body
	 *	@param int senderId
	 *	@param string senderProfileImage
	 *	@param string senderName
	 *
	 *	@return static
	 */
	public static function createMessage($body, $senderId, $senderProfileImage, $senderName)
	{
		$message = new static([
			'body' => $body, 
			'senderid' => $senderId, 
			'senderprofileimage' => $senderProfileImage, 
			'sendername' => $senderName]);

		return $message;
	}

	 /**
	 * A Message has a many message responses.
	 *
	 * @return Collection
	 */
	 public function messageResponses()
    {
        return $this->hasMany('App\MessageResponse')->orderBy('created_at', 'desc');
    }

    /**
	 * Get the last receiver id from the first response attached to an message.
     *
	 * @return mixed
	 */
	public function getLastReceiverId()
	{
		return $this->messageResponses()->first()->receiverid;
	}

	/**
	 * Determine if a message belongs to a user.
	 *	
	 * @param int $userId
     *
	 * @return mixed
	 */
	public function belongsToUser($userId)
	{
		$users = $this->users()->get();

		$userIds = [];

		foreach ($users as $user) {
			
			$userIds[] = $user->id;
		}
		
		return in_array($userId, $userIds);
	}

}
