<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\API\BaseAPIController;
use App\Http\Requests\AuthLoginRequest;
use App\Http\Requests\StoreUserRegisterRequest;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class AuthController extends BaseAPIController
{
    public function __construct()
    {
        $this->responseMessage = [
            'login' => 'Login Berhasil',
            'logout' => 'Logout Berhasil',
            'register' => 'Registrasi Berhasil',
        ];
    }
    public function login(AuthLoginRequest $request, AuthService $service)
    {
        $loginResult = $service->attemptLogin($request->validated());

        if (!$loginResult) {
            return $this->sendError(JsonResponse::HTTP_UNAUTHORIZED, 'Username atau Password tidak terdaftar');
        }

        return $this->sendResponse($loginResult, JsonResponse::HTTP_OK, $this->responseMessage[__FUNCTION__]);
    }

    public function logout()
    {
        Auth::logout();
        return $this->sendResponse(null, JsonResponse::HTTP_OK, $this->responseMessage[__FUNCTION__]);
    }
    public function me()
    {
        $user = Auth::getUser();
        return $this->sendResponse($user);
    }

    public function register(StoreUserRegisterRequest $request, AuthService $service)
    {
        return $this->sendResponse($service->register($request->validated()), JsonResponse::HTTP_OK, $this->responseMessage[__FUNCTION__]);
    }
}
