<?php

namespace App\Http\Middleware;


use Illuminate\Support\Facades\Auth;

use Closure;
use Illuminate\Http\Request;


class CheckToken
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();
        if ($user->role_id == 1  && $user->statusCode == 1) {
            return $next($request);
        }

        return response()->json([
            'message' => 'you are not allowed to'
        ]);
    }
}
