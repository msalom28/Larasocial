<?php namespace App\Repositories\Message;

use App\Message;
use App\User;

interface MessageRepository
{
	public function findById($id);
	public function findByIdWithMessageResponses($id);
	
}