<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthValidate;
use App\Http\Requests\LoginValidate;
use App\Http\Requests\MoneyValidate;
use App\Http\Requests\VerificationValidate;
use App\Services\AuthService;

class AuthController extends Controller
{
    protected $Auth;
    public function __construct(AuthService $auth)
    {
        $this->Auth = $auth;
    }

    public function Register(AuthValidate $request)
    {
        return $this->Auth->register($request);
    }

    public function Verification(VerificationValidate $request)
    {
        return $this->Auth->verification($request);
    }

    public function Login(LoginValidate $request)
    {
        return $this->Auth->login($request);
    }

    public function Logout()
    {
        return $this->Auth->logout();
    }

    public function storeMoney(MoneyValidate $request)
    {
        return $this->Auth->storeMoney($request);
    }
}
