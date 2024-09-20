<?php

namespace App\Services;

use App\Repositories\AuthRepositoryInterface;


class AuthService
{
    protected $authRepository;

    public function __construct(AuthRepositoryInterface $authRepository) {
        $this->authRepository = $authRepository;
    }


    public function register($request)
    {
        return $this->authRepository->register($request);
    }

    public function verification($request)
    {
        return $this->authRepository->verification($request);
    }

    public function login($request)
    {
        return $this->authRepository->login($request);
    }

    public function logout()
    {
        return $this->authRepository->logout();
    }

    public function storeMoney($request)
    {
        return $this->authRepository->storeMoney($request);
    }

    public function sendCode($request)
    {
        return $this->authRepository->sendCode($request);
    }
}
