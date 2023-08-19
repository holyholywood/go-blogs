<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;

class AuthService
{
    protected $userService;
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function attemptLogin($request)
    {

        $token = Auth::attempt($request);

        if (!$token) {
            return false;
        }


        $user = Auth::user();

        return [
            'user' => $user,
            'authorization' => [
                'type' => 'bearer',
                'token' => $token,
            ]
        ];
    }

    public function register($data)
    {
        $data['role'] = 'customer';

        return $this->userService->create($data);
    }
}
