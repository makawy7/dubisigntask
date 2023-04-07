<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateUserRequest;
use App\Interfaces\UserRepositoryInterface;

class UserController extends Controller
{

    public function index()
    {
        return view('index');
    }
    public function create()
    {
        return view('users.create');
    }
}
