<?php namespace App\Repositories\Message;

use App\Message;

class EloquentMessageRepository implements MessageRepository
{	
	/**
	 * Fetch a message by id.
	 *
	 * @param int $id
	 *	
	 * @return mixed
	 */
	public function findById($id)
	{
		return Message::find($id);
	}

	/**
	 * Fetch a message with all responses attached.
	 *
	 * @param int $id
	 *	
	 * @return mixed
	 */
	public function findByIdWithMessageResponses($id)
	{		
		return Message::with(['MessageResponses'])->find($id);
	}
	
}