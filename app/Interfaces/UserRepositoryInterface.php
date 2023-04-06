<?php

namespace App\Interfaces;

use App\Models\User;

interface UserRepositoryInterface
{
    public function createUser(array $data);

    public function attachCertification(User $user, string $name, string $filePath);
    public function attachLocation(User $user, string $location, string $birthDate);
}
