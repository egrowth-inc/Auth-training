<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;

class YourController extends Controller
{
    public function setSecureCookie()
    {
        // 1. SecureかつHttpOnlyなCookieを作成
        $cookie = Cookie::make(
            'secure_cookie',           // Cookie名
            'SecureHelloWorld',        // 値
            60,                        // 有効期限（分）
            null,                      // パス
            null,                      // ドメイン
            true,                      // Secure属性（HTTPSのみ）
            true                       // HttpOnly属性（JSからアクセス不可）
        );

        // 2. レスポンスにCookieを追加
        return response('Secure Cookie has been set!')->cookie($cookie);
    }

    public function getCustomCookie(Request $request)
    {
        $value = $request->cookie('custom_cookie');
        return response("Cookie Value: $value");
    }

    public function showSessionData()
    {
        // セッションデータを取得
        $sessionData = Session::all();

        // セッションデータをレスポンスで返す
        return response()->json($sessionData);
    }
}
