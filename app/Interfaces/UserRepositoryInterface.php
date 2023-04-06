<?php

namespace App\Interfaces;

interface UserRepositoryInterface
{
    public function getUsers();
    public function createUser(array $data);
}
