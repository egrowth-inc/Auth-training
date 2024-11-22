<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class OAuthController extends Controller
{
    // プロバイダーへのリダイレクト
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    // プロバイダーからのコールバック処理
    public function callback($provider)
    {
        try {
            $userSocial = Socialite::driver($provider)->stateless()->user();
        } catch (\Exception $e) {
            return redirect('/login')->with('error', '認証に失敗しました。');
        }

        // ユーザーが既に存在するか確認
        $user = User::where('provider_id', $userSocial->getId())
            ->where('provider', $provider)
            ->first();

        if (!$user) {
            // メールアドレスでユーザーを検索
            $user = User::where('email', $userSocial->getEmail())->first();

            if ($user) {
                // 既存ユーザーにプロバイダー情報を追加
                $user->update([
                    'provider' => $provider,
                    'provider_id' => $userSocial->getId(),
                ]);
            } else {
                // 新規ユーザーを作成
                $user = User::create([
                    'name' => $userSocial->getName(),
                    'email' => $userSocial->getEmail(),
                    'password' => bcrypt(Str::random(16)), // パスワードはランダムに設定
                    'provider' => $provider,
                    'provider_id' => $userSocial->getId(),
                ]);
            }
        }

        // ユーザーをログイン
        Auth::login($user, true);

        return redirect()->intended('/');
    }
}
