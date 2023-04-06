<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Repositories\UserRepository;
use App\Interfaces\UserRepositoryInterface;

class CreateUser extends Component
{
    protected UserRepositoryInterface $userRepository;
    public $successMessage;
    public $username;
    public $email;
    public $bio;
    public $user_type = 'standard';
    public $rules = [
        'user_type' => ['required', 'string', 'in:standard,certified,locationed'],
        'username' => ['required', 'string', 'unique:users,username'],
        'email' => ['required', 'string', 'email', 'unique:users,email'],
        'bio' => ['nullable', 'string'],
    ];
    public function __construct()
    {
        $this->userRepository = new UserRepository();
    }
    public function render()
    {
        return view('livewire.create-user');
    }
    public function updatedUserName()
    {
        $this->validateOnly('username');
    }
    public function updatedEmail()
    {
        $this->validateOnly('email');
    }
    public function createUser()
    {
        $this->validate();
        $this->userRepository->createUser([
            'user_type' => $this->user_type,
            'username' => $this->username,
            'email' => $this->email,
            'bio' => $this->bio,
        ]);
        $this->successMessage = 'User Created Successfully';
    }
}
