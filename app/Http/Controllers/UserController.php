<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateUserRequest;
use App\Interfaces\UserRepositoryInterface;

class UserController extends Controller
{

    public function create()
    {
        return view('users.create');
    }
    public function show()
    {
        return view('users.show');
    }
}
