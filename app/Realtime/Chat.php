<?php namespace App\Realtime;

class Chat extends Realtime
{
	/**
	 * Send chat message
	 * 
	 * @param int $userId
	 *
	 * @param int $clientCode
	 *
	 * @param int $fromId
	 *
	 * @param string $message
	 *
	 */
	public function sendMessageTo($userId = "", $clientCode = "", $fromId = "", $message = "")
	{
		$this->broadcastTo($userId, $clientCode, $fromId, $message);
	}
}