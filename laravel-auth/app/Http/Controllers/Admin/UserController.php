<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * ユーザー一覧の表示
     */
    public function index()
    {
        $users = User::with('roles')->paginate(10); // ページネーションを適用
        return view('admin.users.index', compact('users'));
    }

    /**
     * ユーザー編集フォームの表示
     */
    public function edit(User $user)
    {

        $this->authorize('update', $user); // ポリシーの適用

        $roles = Role::all(); // すべてのロールを取得
        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * ユーザー情報の更新
     */
    public function update(Request $request, User $user)
    {
        // ポリシーの適用
        $this->authorize('update', $user);

        // バリデーション
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => "required|email|unique:users,email,{$user->id}",
            'password' => 'nullable|string|min:8|confirmed',
            'roles' => 'required|array',
            'roles.*' => 'exists:roles,name',
        ]);

        // ユーザー情報の更新
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        if (!empty($validated['password'])) {
            $user->password = bcrypt($validated['password']);
        }
        $user->save();

        // ロールの更新
        $user->syncRoles($validated['roles']);

        return redirect()->route('admin.users.index')->with('success', 'ユーザー情報が更新されました。');
    }



    /**
     * ユーザー削除
     */
    public function destroy(User $user)
    {

        $this->authorize('delete', $user); // ポリシーの適用

        // ユーザー削除
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'ユーザーが削除されました。');
    }

    // その他のリソースメソッド（create, store, show）は必要に応じて実装
}
