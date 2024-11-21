<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\Admin\UserController;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\YourController;



// 認証関連のルートをインクルード
require __DIR__ . '/auth.php';

// ホームページ
Route::get('/', function () {
    return view('welcome');
});

// ダッシュボード（認証済み、メール認証済み、userロールを持つユーザーのみアクセス可能）
Route::middleware(['auth', 'verified', 'role:user'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

// 管理者専用ルート（認証済みかつadminロールを持つユーザーのみアクセス可能）
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('dashboard'); // 管理者ダッシュボード
    Route::resource('users', UserController::class); // ユーザー管理リソースルート
});

// プロファイル関連のルート（認証済みユーザーのみ）
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// パーミッションベースの認可
Route::middleware(['auth', 'permission:edit articles'])->group(function () {
    Route::get('/edit-article', [ArticleController::class, 'edit'])->name('articles.edit');
});

Route::get('/login/google', function () {
    return Socialite::driver('google')->redirect();
})->name('login.google');

Route::get('/login/google/callback', function () {
    $user = Socialite::driver('google')->user();
    // ユーザー情報を保存してログイン処理を行う
    dd($user); // 取得したユーザー情報を表示
});

// カスタムCookieの設定と取得
Route::get('/set-cookie', [YourController::class, 'setCustomCookie']);
Route::get('/get-cookie', [YourController::class, 'getCustomCookie']);
Route::get('/session-data', [YourController::class, 'showSessionData']);