<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateUserRequest;
use App\Interfaces\UserRepositoryInterface;

class UserController extends Controller
{
    protected UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function store(CreateUserRequest $request)
    {
        $user = $this->userRepository->createUser(request()->only(['type', 'username', 'email', 'bio']));
        if ($request->user_type === 'locationed') {
            $this->userRepository->attachLocation($user, $request->map_location, $request->date_of_birth);
        }
        return response()->json(['message' => 'User created successfully', 'user' => $user], 201);
    }
}
