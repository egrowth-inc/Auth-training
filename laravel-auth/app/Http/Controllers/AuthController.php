<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends Controller
{
    /**
     * ユーザー登録
     */
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8',
        ]);

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);

        $token = JWTAuth::fromUser($user);

        return response()->json([
            'message' => 'ユーザー登録が成功しました。',
            'user' => $user,
            'token' => $token
        ], 201);
    }

    /**
     * ログイン
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => '無効な認証情報'], 401);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'トークンの生成に失敗しました'], 500);
        }

        return response()->json([
            'message' => 'ログインに成功しました。',
            'token' => $token
        ]);
    }

    /**
     * ログアウト
     */
    public function logout(Request $request)
    {
        try {
            JWTAuth::invalidate(JWTAuth::getToken());
            return response()->json(['message' => 'ログアウトに成功しました。']);
        } catch (JWTException $e) {
            return response()->json(['error' => 'ログアウトに失敗しました'], 500);
        }
    }

    /**
     * 認証されたユーザー情報の取得
     */
    public function user(Request $request)
    {
        return response()->json(Auth::user());
    }
}
