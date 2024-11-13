<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;

// 認証関連のルートをインクルード
require __DIR__ . '/auth.php';

// ホームページ
Route::get('/', function () {
    return view('welcome');
});

// ダッシュボード（認証済みかつメール認証済みのユーザーのみアクセス可能）
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

// 管理者専用のルート（認証済みかつadminロールを持つユーザーのみアクセス可能）
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
});

// 一般ユーザー専用ルート
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
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
