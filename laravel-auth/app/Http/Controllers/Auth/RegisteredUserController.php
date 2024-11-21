<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Spatie\Permission\Models\Role; // 追加

class RegisteredUserController extends Controller
{
    public function create()
    {
        return view('auth/register');
    }

    public function store(Request $request)
    {
        // バリデーション
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // ユーザーの作成
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // ロールの割り当て
        if ($user->email === 'admin@example.com') {
            $user->assignRole('admin');
        } else {
            $user->assignRole('user');
        }

        // 登録イベントの発火
        event(new Registered($user));

        // ユーザーのログイン
        Auth::login($user);

        // リダイレクト先の決定
        if ($user->hasRole('admin')) {
            return redirect()->intended('/admin');
        } else {
            return redirect()->intended('/dashboard');
        }
    }
}