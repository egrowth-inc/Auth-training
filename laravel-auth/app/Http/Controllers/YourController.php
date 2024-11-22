<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;

class YourController extends Controller
{
    public function setSecureCookie()
    {
        // SecureなCookieを設定（ローカルではSecure=false）
        $cookie = Cookie::make(
            'secure_cookie',           // Cookie名
            'SecureHelloWorld',        // 値
            60,                        // 有効期限（分）
            null,                      // パス
            null,                      // ドメイン
            false,                     // Secure属性（ローカルならfalse）
            true                       // HttpOnly属性
        );

        return response('Secure Cookie has been set!')->cookie($cookie);
    }

    public function getCustomCookie(Request $request)
    {
        // Cookie名を修正して一致させる
        $value = $request->cookie('secure_cookie');

        // フラッシュデータを設定
        session()->flash('message', 'これはフラッシュメッセージです！');

        // セッションの中身を確認
        return response()->json(session()->all());
    }

    public function showSessionData()
    {
        // セッションデータを確認
        $sessionData = Session::all();
        return response()->json($sessionData);
    }
}
