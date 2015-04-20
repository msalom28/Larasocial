<?php namespace App;

use Illuminate\Database\Eloquent\Model;

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

}
