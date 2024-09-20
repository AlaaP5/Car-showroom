<?php

namespace App\Interfaces;

use App\DTOs\UserDTO;

interface AuthRepositoryInterface
{
    public function register(UserDTO $request);
    public function verification(array $request);
    public function login(array $request);
    public function logout();
    public function storeMoney(array $request);
    public function sendCode(array $request);
}
