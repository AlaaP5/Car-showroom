<?php

namespace App\Services;

use App\DTOs\UserDTO;
use App\Interfaces\AuthRepositoryInterface;
use Illuminate\Http\JsonResponse;

class AuthService
{
    protected $authRepository;

    public function __construct(AuthRepositoryInterface $authRepository) {
        $this->authRepository = $authRepository;
    }


    public function register(UserDTO $userDTO): JsonResponse
    {
        return $this->authRepository->register($userDTO->toArray());
    }

    public function verification($request): JsonResponse
    {
        return $this->authRepository->verification($request);
    }

    public function login(UserDTO $userDTO): JsonResponse
    {
        return $this->authRepository->login($userDTO->toArray());
    }

    public function logout(): JsonResponse
    {
        return $this->authRepository->logout();
    }

    public function sendCode($request): JsonResponse
    {
        return $this->authRepository->sendCode($request);
    }
}
