# 認可の基本的な概念（ユーザーのアクセス権限を制御するプロセス）を理解している。

## 認可は「誰がどの操作をして良いか」を管理する仕組みです

一般ユーザー: 自分のプロフィールを見る、編集する。

管理者: 全ユーザーのプロフィールを見る、編集する。


## 一般ユーザーと管理者ユーザーでログインしてみる



一般ユーザー

`好きなメールアドレス`でユーザー登録をする

DBを確認:

usersテーブルの`role`がuserと確認

---

管理者

`admin@example.com`でユーザー登録をする

DBを確認:

usersテーブルの`role`がadminと確認

http://127.0.0.1:8000/admin

にアクセスすると管理者画面へ遷移でき登録されてきたユーザーを編集、削除することができる

---





一般ユーザーと管理者画面にいくそれぞれのプロセス

```php

// RegisteredUserController.php

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
```

```php
       if ($user->email === 'admin@example.com') {
            $user->assignRole('admin');
        } else {
            $user->assignRole('user');
        }
```

- 管理者 (admin) ロールの割り当て: admin@example.com であれば、admin ロールを付与します。
- 一般ユーザー (user) ロールの割り当て: 上記以外の場合、user ロールを付与します。

1. メールアドレスを確認。
2. 条件に応じて適切なロールを割り当て。


```php
event(new Registered($user));
```

Laravelのイベントシステムを利用して、登録（ユーザー作成）時にイベントを発火させる仕組みです。

## イベントとは？

イベントは特定のアクションが起きた際に、その出来事をLaravel全体に通知する仕組みです。

## 例え
「新しいユーザーが登録されたとき、以下のような流れが発生します」：

イベント発火 (ベルを鳴らす):

「誰かが家に来た！」と知らせるためにベルを鳴らします。
これは event(new Registered($user)) に該当します。
リスナー (役割を持つ人たち):

- ベルの音を聞いて、それぞれの役割を果たします。
- 家族A: 玄関を開ける（メール送信）
- 家族B: お茶を準備する（ログ記録）
- 家族C: 家の中を片付ける（追加の登録処理）


```php
Auth::login($user);
```

## 処理の内容:

- 登録されたユーザーを自動的にログインさせます。
- この時点でセッションが作成され、認証情報が保存されます。

## 流れ:

- Auth::login($user) によって認証状態が設定される。
- セッションにユーザー情報（ユーザーIDなど）が保存される。

```php
        // リダイレクト先の決定
        if ($user->hasRole('admin')) {
            return redirect()->intended('/admin');
        } else {
            return redirect()->intended('/dashboard');
        }
```

## ユーザーのロールを確認し、それに応じて適切な画面にリダイレクトします。

- 管理者ロール (admin) の場合: /admin へリダイレクト。
- 一般ユーザーロール (user) の場合: /dashboard へリダイレクト。

## 流れ:

- $user->hasRole('admin') を使用して、ユーザーのロールを確認。
条件に応じてリダイレクト先を決定。
リダイレクト先が設定される。

そして`web.php`に戻る