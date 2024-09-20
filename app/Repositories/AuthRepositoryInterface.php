<?php

namespace App\Repositories;


interface AuthRepositoryInterface
{
    public function register(array $request);
    public function verification(array $request);
    public function login(array $request);
    public function logout();
    public function storeMoney(array $request);
    public function sendCode(array $request);
}
