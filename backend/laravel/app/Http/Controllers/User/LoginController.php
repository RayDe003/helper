<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('login', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('auth');
            return response()->json(['message' => 'Аутентификация успешна', 'user' => $user, 'token' => $token->plainTextToken]);
        }

        return response()->json(['message' => 'Неправильные учетные данные'], 401);
    }

    public function info()
    {
        $user = auth()->user();
        return $user;
    }
}
