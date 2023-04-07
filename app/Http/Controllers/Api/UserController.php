<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
        $user = $this->userRepository->createUser($request->only(['type', 'username', 'email', 'bio']));
        if ($request->user_type === 'locationed') {
            $this->userRepository->attachLocation($user, $request->map_location, $request->date_of_birth);
            $user->load('location');
        }
        if ($request->user_type === 'certified') {
            $this->userRepository->attachCertification($user, $request->cert_name, $request->file_path);
            $user->load('certification');
        }
        return response()->json(['message' => 'User created successfully', 'user' => $user], 201);
    }

    public function uploadCertification(Request $request)
    {
        $request->validate([
            'cert_file' => ['required', 'mimes:jpeg,jpg,png,pdf', 'max:10240'],
        ]);
        $file = $request->file('cert_file');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $file->storeAs('certifications', $fileName, 'public');

        return response()->json(['message' => 'File uploaded successfully', 'file_path' => $fileName], 201);
    }
}
