<?php

namespace App\Http\Controllers;

use App\DTOs\UserDTO;
use App\Http\Requests\AuthValidate;
use App\Http\Requests\LoginValidate;
use App\Http\Requests\VerificationValidate;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    protected AuthService $auth;
    public function __construct(AuthService $authService)
    {
        $this->auth = $authService;
    }

    public function register(AuthValidate $request): JsonResponse
    {
        $userDTO = UserDTO::fromArray($request->validated());

        return $this->auth->register($userDTO);
    }

    public function verification(VerificationValidate $request): JsonResponse
    {
        return $this->auth->verification($request);
    }

    public function login(LoginValidate $request): JsonResponse
    {
        $loginDTO = UserDTO::fromArray($request->validated());

        return $this->auth->login($loginDTO);
    }

    public function logout(): JsonResponse
    {
        return $this->auth->logout();
    }
}
