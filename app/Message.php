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

}
