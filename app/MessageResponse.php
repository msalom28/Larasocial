<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class MessageResponse extends Model {

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['message_id','open', 'body', 'senderid', 'receiverid', 'senderprofileimage', 'sendername'];

	/**
	 * Many Responses belong to many users.
	 *
	 * @return Collection
	 */
	 public function users()
    {
        return $this->belongsToMany('App\User')->withTimestamps();
    }


    /**
	 * Many Responses belong to one Message
	 *
	 * @return Email
	 */
	 public function message()
    {
        return $this->belongsTo('App\Message')->withTimestamps();
    }

    /**
	 *  Create a new response object. 
	 *
	 *	@param string body
	 *	@param int senderId
	 *	@param string senderProfileImage
	 *	@param string senderName
	 *
	 *	@return static
	 */
	public static function createMessageResponse($body, $senderId, $receiverId, $senderProfileImage, $senderName)
	{
		$response = new static([
			
			'body' => $body,
			'senderid' => $senderId,
			'receiverid' => $receiverId, 
			'senderprofileimage' => $senderProfileImage, 
			'sendername' => $senderName]);

		return $response;
	}

	/**
	 * Get the message response subject.
     *
	 * @return string
	 */
	public function getMessageResponseSubject()
	{
	 	return substr($this->body, 0, 35)."...";
	}


	/**
	 *  Determine if message response was opened by current user.
	 *
	 *	@param int userId
	 *
	 *	@return boolean
	 */
	public function hasBeenOpenedBy($userId)
	{
		return DB::table('message_response_user')->where('user_id', $userId)->where('message_response_id', $this->id)->pluck('open');
	}


	/**
	 *  Determine if message response was sent by a user.
	 *
	 *	@param int userId
	 *
	 *	@return boolean
	 */
	public function wasSentByThisUser($userId)
	{
		return ($this->senderid == $userId) ? true : false;
	}

}
