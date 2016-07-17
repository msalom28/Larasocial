<?php namespace App\Repositories\User;

interface UserRepository
{
    public function getPaginated($howMany, $byKeyword);

    public function findById($id);

    public function findManyById(array $ids);

    public function findByIdWithFeeds($id);

    public function findByIdWithMessages($id);

    public function findByIdWithFriends($userId);
}