<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Feed extends Model {
	
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['body', 'poster_firstname', 'poster_profile_image'];
	/**
	 * A feed belongs to a User.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function user()
	{
		return $this->belongsTo(User::class);
	}

	/**
	 *  Publish a new feed.
	 *
	 *	@param string body
	 *
	 *	@param string $poster_firstname
	 *
	 *	@param string $poster_profile_image
	 *
	 *	@return static
	 */
	public static function publish($body, $poster_firstname, $poster_profile_image)
	{
		$feed = new static(compact('body', 'poster_firstname', 'poster_profile_image'));

		return $feed;
	}

	/**
	 *  Get the amount of feeds related to current User.
	 *
	 *	@param array $userIds
	 *
	 *	@return int
	 */
	public static function getTotalCountFeedsForUser($userIds)
	{
		return self::whereIn('user_id', $userIds)->count();
	}

}
