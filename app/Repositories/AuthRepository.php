<?php

namespace App\Repositories;

use App\Events\CreateUserEvent;
use App\Helpers\DateNow;
use App\Interfaces\AuthRepositoryInterface;
use App\Mail\SendCodeMail;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;


class AuthRepository implements AuthRepositoryInterface
{
    public function register(array $input): JsonResponse
    {
        $input['password'] = Hash::make($input['password']);
        $input['role'] = 'user';
        $input['date'] = DateNow::presentTime(now());
        $user = User::create($input);
        $token = $user->createToken('Having')->accessToken;

        Event::dispatch(new CreateUserEvent($user));
        return response()->json(['token' => $token, 'message' => 'Code sent to your email'], 201);
    }


    public function sendCode($request): JsonResponse
    {
        try {
            $code = random_int(1000, 9999);
            $user = User::where('email', $request->email)->first();
            $user->code = $code;
            $user->statusCode = false;
            $user->save();

            Mail::to($user->email)->send(new SendCodeMail($user));
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 422);
        }
    }


    public function verification($request): JsonResponse
    {
        $user = User::where('id', Auth::id())->first();

        if ($request->code == $user->code) {
            $user->statusCode = true;
            $user->save();
            return response()->json(['message' => 'Your account has been confirmed'], 200);
        } else
            return response()->json(['message' => 'your code is not correct'], 422);
    }


    public function login(array $request): JsonResponse
    {
        if (Auth::attempt(['email' => $request['email'], 'password' => $request['password']])) {
            $user = auth()->user();

            if ($user->statusCode != true) {
                return response()->json(['message' => 'User account inactive'], 403);
            }

            $token = $user->createToken('Having')->accessToken;
            return response()->json(['token' => $token], 200);
        }
        return response()->json(['message' => 'Invalid login'], 422);
    }


    public function logout(): JsonResponse
    {
        /**@var \App\Models\MyUserModel */
        $user = auth()->user();
        $user->tokens()->delete();
        return response()->json(['message' => 'logged out Successfully'], 200);
    }
}
