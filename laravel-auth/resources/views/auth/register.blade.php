<!-- ユーザー登録画面 -->
<x-guest-layout>
    <!-- フォームの開始。POSTメソッドで/registerルートに送信 -->
    <form method="POST" action="{{ route('register') }}">
        @csrf <!-- CSRFトークンを生成。セキュリティのために必要 -->

        <!-- 名前入力フィールド -->
        <div>
            <!-- 名前ラベル -->
            <x-input-label for="name" :value="__('Name')" />
            <!-- 名前テキスト入力 -->
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required
                autofocus autocomplete="name" />
            <!-- 名前入力時のエラーメッセージ表示 -->
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- メールアドレス入力フィールド -->
        <div class="mt-4">
            <!-- メールアドレスラベル -->
            <x-input-label for="email" :value="__('Email')" />
            <!-- メールアドレステキスト入力 -->
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                required autocomplete="username" />
            <!-- メールアドレス入力時のエラーメッセージ表示 -->
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- パスワード入力フィールド -->
        <div class="mt-4">
            <!-- パスワードラベル -->
            <x-input-label for="password" :value="__('Password')" />

            <!-- パスワード入力 -->
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="new-password" />

            <!-- パスワード入力時のエラーメッセージ表示 -->
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- パスワード確認入力フィールド -->
        <div class="mt-4">
            <!-- パスワード確認ラベル -->
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <!-- パスワード確認入力 -->
            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                name="password_confirmation" required autocomplete="new-password" />

            <!-- パスワード確認入力時のエラーメッセージ表示 -->
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- フォームの下部：ログインリンクと登録ボタン -->
        <div class="flex items-center justify-end mt-4">
            <!-- 既に登録済みのユーザー向けログインリンク -->
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 
                      dark:hover:text-gray-100 rounded-md focus:outline-none 
                      focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 
                      dark:focus:ring-offset-gray-800"
                href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <!-- 登録ボタン -->
            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
