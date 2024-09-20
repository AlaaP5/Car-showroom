<?php

namespace App\Repositories;

use App\Events\CreateUserEvent;
use App\Mail\SendCodeMail;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthRepository implements AuthRepositoryInterface
{

    public function register($request)
    {
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $input['role_id'] = 2;
        $user = User::create($input);
        $token = $user->createToken('Having')->accessToken;
        $success = [
            'information' => $user,
            'token' => $token
        ];
        Event::dispatch(new CreateUserEvent($user));

        return response()->json(
            [
                'data' => $success,
                'message' => 'code sent to your gmail'
            ],
            201
        );
    }


    public function sendCode($request)
    {
        try {
            $code = random_int(10000, 99999);
            $user = User::where('email', $request->email)->first();
            $user->code = $code;
            $user->StatusCode = false;
            $user->save();

            Mail::to($user->email)->send(new SendCodeMail($user));
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 422);
        }
    }



    public function verification($request)
    {
        $id = Auth::id();
        $user = User::where('id', $id)->first();
        if ($request->code == $user->code) {
            $user->StatusCode = true;
            $user->save();
            Wallet::create([
                'quantity' => 0,
                'user_id' => $id
            ]);
            return response()->json(['message' => 'Success'], 200);
        } else
            return response()->json(['message' => 'your code is not correct'], 422);
    }


    public function login($request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'StatusCode' => true])) {
            $user = User::query()->find(auth()->user()['id']);
            $success['token'] = $user->createToken('Having')->accessToken;
            $success['information'] = $user;
            return response()->json(['data' => $success], 200);
        }
        return response()->json(['message' => 'Invalid login'], 422);
    }


    public function logout()
    {
        /**@var \App\Models\MyUserModel */
        $user = auth()->user();
        $user->tokens()->delete();
        return response()->json(['message' => 'logged out Successfully'], 200);
    }


    public function storeMoney($request)
    {
        $user = User::where('email', $request->email)->first();
        if (empty($user)) {
            return response()->json(['message' => 'User not found'], 404);
        }
        $wallet = Wallet::where('user_id', $user->id)->first();
        $wallet->quantity += $request->quantity;
        $wallet->save();
        return response()->json(['message' => 'Money added successfully'], 200);
    }
}
