<?php namespace App\Realtime;

use ElephantIO\Client;
use ElephantIO\Engine\SocketIO\Version1X;

abstract class Realtime
{
	/**
	 * @var Object
	 */
	protected $socketClient;
	/**
	 * Create a new Realtime instance.
	 */
	public function __construct()
	{
		$this->socketClient = new Client(new Version1X('http://localhost:3000'));
	}
	/**
	 * Send a websocket broadcast to all connected users.
	 * @param array $userIds
	 * @param int clientCode
	 * @param int relatedToId
	 * @param string message
	 *
	 */
	public function broadcastToAll($userIds = [], $clientCode = "", $relatedToId = "", $message = "")
	{
		$this->socketClient->initialize();

		foreach ($userIds as $userId) {
			$this->socketClient->emit('broadcast', [
				'userId' => $userId, 
				'receiverId' => $userId, 
				'relatedToId' => $relatedToId, 
				'clientcode' => $clientCode,
				'message' => $message
			]);
		
		}
		$this->socketClient->close();
	}
	/**
	 * Send a websocket broadcast to one connected user.
	 * @param int $userId
	 * @param int clientCode
	 * @param int relatedToId
	 * @param string message
	 *
	 */
	public function broadcastTo($userId = "", $clientCode = "", $relatedToId = "", $message = "")
	{
		$this->socketClient->initialize();
		
		$this->socketClient->emit('broadcast', [
			'userId' => $userId, 
			'receiverId' => $userId, 
			'relatedToId' => $relatedToId,
			'clientcode' => $clientCode,
			'message' => $message
		]);
		$this->socketClient->close();
	}
}