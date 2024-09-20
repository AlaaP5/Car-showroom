<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthValidate;
use App\Http\Requests\LoginValidate;
use App\Http\Requests\MoneyValidate;
use App\Http\Requests\VerificationValidate;
use App\Services\AuthService;

class AuthController extends Controller
{
    protected $auth;
    public function __construct(AuthService $authService)
    {
        $this->auth = $authService;
    }

    public function Register(AuthValidate $request)
    {
        return $this->auth->register($request);
    }

    public function Verification(VerificationValidate $request)
    {
        return $this->auth->verification($request);
    }

    public function Login(LoginValidate $request)
    {
        return $this->auth->login($request);
    }

    public function Logout()
    {
        return $this->auth->logout();
    }

    public function storeMoney(MoneyValidate $request)
    {
        return $this->auth->storeMoney($request);
    }
}
