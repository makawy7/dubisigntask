<?php

namespace App\Repositories;

use Carbon\Carbon;
use App\Models\User;
use App\Interfaces\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    public function createUser(array $data)
    {
        return User::create($data);
    }

    public function attachCertification(User $user, string $name, string $filePath)
    {
        $user->certification()->create([
            'cert_name' => $name,
            'file_path' => $filePath
        ]);
    }

    public function attachLocation(User $user, string $location, string $birthDate)
    {
        $user->location()->create([
            'map_location' => $location,
            'date_of_birth' => Carbon::parse($birthDate)->toDateString()
        ]);
    }
}
