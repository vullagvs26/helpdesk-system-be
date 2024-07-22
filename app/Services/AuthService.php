<?php

namespace App\Services;

use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthService
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function register(array $data): User
    {
        $data['password'] = Hash::make($data['password']);
        return $this->userRepository->storeUser($data);
    }

    public function login(array $credentials)
    {
        if (!$token = Auth::attempt($credentials)) {
            return false;
        }

        return $token;
    }

    public function logout()
    {
        Auth::logout();
    }
}
