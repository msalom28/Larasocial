<?php namespace App\Repositories\Message;

interface MessageRepository
{
    public function findById($id);

    public function findByIdWithMessageResponses($id);

}