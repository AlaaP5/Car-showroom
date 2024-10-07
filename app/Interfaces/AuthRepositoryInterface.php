<?php

namespace App\Interfaces;


interface AuthRepositoryInterface
{
    public function register(array $request);
    public function verification(array $request);
    public function login(array $request);
    public function logout();
    public function sendCode(array $request);
}
