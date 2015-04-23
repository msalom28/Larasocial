<?php namespace App\Realtime;

class Events extends Realtime
{
	/**
	 * Update chat status bar of current user and her friends with chat status update.
	 * 
	 * @param array $userIds
	 *
	 * @param int $clientCode
	 *
	 * @param int $relatedToId
	 *
	 * @param string $message
	 * return void
	 *
	 */
	public function updateChatStatusBar($userIds = [], $clientCode = "", $relatedToId = "", $message = "")
	{
		$this->broadcastToAll($userIds, $clientCode, $relatedToId, $message);
	}
	/**
	 * Update the chat list of a connected user when a friend has unfriended her.
	 * 
	 * @param int $userId
	 *
	 * @param int $clientCode
	 *
	 * @param int $relatedToId
	 *
	 * @param string $message
	 *
	 * return void
	 */
	public function updateChatListFriendRemoved($userId = "", $clientCode = "", $relatedToId = "", $message = "")
	{
		$this->broadcastTo($userId, $clientCode, $relatedToId, $message);
	}
}