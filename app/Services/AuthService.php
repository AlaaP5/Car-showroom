<?php

namespace App\Services;

use App\DTOs\UserDTO;
use App\Interfaces\AuthRepositoryInterface;

class AuthService
{
    protected $authRepository;

    public function __construct(AuthRepositoryInterface $authRepository) {
        $this->authRepository = $authRepository;
    }


    public function register($request)
    {
        $userDTO = UserDTO::fromArray([
            'FirstName' => $request->FirstName,
            'LastName' => $request->LastName,
            'email' => $request->email,
            'password' => $request->password,
            'phone_number' => $request->phone_number
        ]);

        return $this->authRepository->register($userDTO);
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
