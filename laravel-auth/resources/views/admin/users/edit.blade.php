@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>ユーザー編集</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>エラー:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.users.update', $user) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- 名前 -->
            <div class="mb-3">
                <label for="name" class="form-label">名前</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $user->name) }}"
                    required>
            </div>

            <!-- メールアドレス -->
            <div class="mb-3">
                <label for="email" class="form-label">メールアドレス</label>
                <input type="email" name="email" id="email" class="form-control"
                    value="{{ old('email', $user->email) }}" required>
            </div>

            <!-- パスワード -->
            <div class="mb-3">
                <label for="password" class="form-label">新しいパスワード（未入力で変更なし）</label>
                <input type="password" name="password" id="password" class="form-control">
            </div>

            <!-- パスワード確認 -->
            <div class="mb-3">
                <label for="password_confirmation" class="form-label">パスワード確認</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
            </div>

            <!-- ロール選択 -->
            <div class="mb-3">
                <label for="roles" class="form-label">ロール</label>
                <select name="roles[]" id="roles" class="form-select" multiple required>
                    @foreach ($roles as $role)
                        <option value="{{ $role->name }}" {{ $user->hasRole($role->name) ? 'selected' : '' }}>
                            {{ ucfirst($role->name) }}
                        </option>
                    @endforeach
                </select>
                <small class="form-text text-muted">複数選択可能です。</small>
            </div>

            <!-- 更新ボタン -->
            <button type="submit" class="btn btn-primary">更新</button>
            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">キャンセル</a>
        </form>
    </div>
@endsection
